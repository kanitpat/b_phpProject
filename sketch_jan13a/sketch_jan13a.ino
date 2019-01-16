#include <ESP8266WiFi.h> //เป็นการเรียกใช้ Library โมดูล ESP8266
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
#include <time.h>
#include <Arduino.h>
void Line_Notify(String message) ;
#define LINE_TOKEN "eIUiqHOHmcPIEOC5uetSxY1lOTfEBubHDI7yz9qy8Zf"
String message_cm ,comment,messagenoti; // ArduinoIDE เวอร์ชั่นใหม่ ๆ ใส่ภาษาไทยลงไปได้เลย

const int pingPin = D1;
int inPin = D2;
const char* ssid = "เค้าเต้อ"; //สร้างตัวแปรไว้เก็บชื่อ ssid ของ AP ของเรา
const char* pass = "52123401"; //สร้างตัวแปรไว้เก็บชื่อ password ของ AP ของเรา
int dst = 0;
ESP8266WiFiMulti WiFiMulti;

int timezone = 7 * 3600;

void setup() {
  Serial.begin(9600);//ตั้งค่าใช้งาน serial ที่ baudrate 115200

  for (uint8_t t = 4; t > 0; t--) {
    Serial.printf("[SETUP] WAIT %d...\n", t);
    Serial.flush();
    delay(1000);
  }
  WiFiMulti.addAP("เค้าเต้อ", "52123401"); // ssid , password
  randomSeed(50);

  configTime(timezone, dst, "pool.ntp.org", "time.nist.gov");
  Serial.println("\nWaiting for time");
  while (!time(nullptr)) {
    Serial.print(".");
    delay(1000);
  }
}//close setup

void Line_Notify(String message) {
  axTLS::WiFiClientSecure client;

  if (!client.connect("notify-api.line.me", 443)) {
    Serial.println("connection failed");
    return;
  }

  String req = "";
  req += "POST /api/notify HTTP/1.1\r\n";
  req += "Host: notify-api.line.me\r\n";
  req += "Authorization: Bearer " + String(LINE_TOKEN) + "\r\n";
  req += "Cache-Control: no-cache\r\n";
  req += "User-Agent: ESP8266\r\n";
  req += "Content-Type: application/x-www-form-urlencoded\r\n";
  req += "Content-Length: " + String(String("message=" + message).length()) + "\r\n";
  req += "\r\n";
  req += "message=" + message;
  Serial.println(req);
  client.print(req);
  delay(2000);

  Serial.println("-------------");
  while (client.connected()) {
    String line = client.readStringUntil('\n');
    if (line == "\r") {
      break;
    }
    Serial.println(line);
  }
  Serial.println("-------------");
}


void loop()
{
  double duration, cm;
  pinMode(pingPin, OUTPUT);
  digitalWrite(pingPin, LOW);
  delayMicroseconds(2);
  digitalWrite(pingPin, HIGH);
  delayMicroseconds(5);
  digitalWrite(pingPin, LOW);
  pinMode(inPin, INPUT);
  duration = pulseIn(inPin, HIGH);
  cm = microsecondsToCentimeters(duration);
  Serial.print(cm);
  Serial.println("cm");
  delay(2000);

  if ((WiFiMulti.run() == WL_CONNECTED)) {
    HTTPClient http;

    String url = "http://192.168.43.104/b_phpProject/addbase.php?level=" + String(cm) ;
    Serial.println(url);
    http.begin(url); //HTTP

    int httpCode = http.GET();
    if (httpCode > 0) {
      Serial.printf("[HTTP] GET... code: %d\n", httpCode);
      if (httpCode == HTTP_CODE_OK) {
        String payload = http.getString();
        Serial.println(payload);
      }
    } else {
      Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
    }
    http.end();
  }
  configTime(timezone, dst, "pool.ntp.org", "time.nist.gov"); //ดีงเวลาปัจจุบันจาก Server
  time_t now = time(nullptr);
  struct tm* p_tm = localtime(&now);
  Serial.print(p_tm->tm_hour);
  Serial.print(":");
  Serial.print(p_tm->tm_min);
  Serial.print(":");
  Serial.print(p_tm->tm_sec);
  Serial.println("");
  delay(2000);
    message_cm = cm;
  if (cm <= 150) {
    comment = "ระดับน้ำผิดปกติ !! : สูงขึ้น " ;
    messagenoti = comment + message_cm + " เซนติเมตร";
    Line_Notify(messagenoti);

    //    HTTPClient http;
    //    http.begin("http://192.168.43.104/b_phpProject/insert_data.php");
    //    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    //    int httpCode = http.POST("temp=" + message3 + "&humidity=" + message5 + "&message=" + comment);


  } else {
    comment = "ระดับน้ำผิดปกติ !! : ลดลง " ;
    messagenoti = comment + message_cm + " เซนติเมตร";
    Line_Notify(messagenoti);

    //    HTTPClient http;
    //    http.begin("http://192.168.43.104/b_phpProject/insert_data.php");
    //    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    //    int httpCode = http.POST("temp=" + message3 + "&humidity=" + message5 + "&message=" + comment);



  }
}

long microsecondsToCentimeters(long microseconds)
{
  // ความเร็วเสียงในอากาศประมาณ 340 เมตร/วินาที หรือ 29 ไมโครวินาที/เซนติเมตร
  // ระยะทางที่ส่งเสียงออกไปจนเสียงสะท้อนกลับมาสามารถใช้หาระยะทางของวัตถุได้
  // เวลาที่ใช้คือ ระยะทางไปกลับ ดังนั้นระยะทางคือ ครึ่งหนึ่งของที่วัดได้
  return microseconds / 29 / 2;
}
