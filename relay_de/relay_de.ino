#include <ESP8266WiFi.h>
#include <Arduino.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
#include <time.h>
const char* host = "192.168.43.104";  //Doamin ที่ต้องการดึงค่ามาใช้
ESP8266WiFiMulti WiFiMulti;
#include <time.h>
int timezone = 7 * 3600;
double duration, cm;
int inPin = D3;//ขาเซนเซอร์สีส้ม
const int pingPin = D2; //ขาเซนเซอร์สีเขียว
const char* ssid = "Counterpan";
const char* pass = "52123401";
int dst = 0;
int ch1 = 0;

int ledPin1 = D1; // ขา D1 ขารีเลย์
HTTPClient http;


int relay = 0;
int status_device = 0;
int userid = 0;
void Line_Notify(String message) ;
#define LINE_TOKEN "eIUiqHOHmcPIEOC5uetSxY1lOTfEBubHDI7yz9qy8Zf"
String message_cm , comment, messagenoti, ment = "line"; // ArduinoIDE เวอร์ชั่นใหม่ ๆ ใส่ภาษาไทยลงไปได้เลย
int cm_0 = 0 ;
WiFiServer server(80);

void setup() {
  Serial.begin(9600);
  pinMode(D4, OUTPUT);

  // ประกาศขา เป็น Output
  pinMode(ledPin1, OUTPUT);

  // เริ่มต้น ให้ Logic ตำแหน่งขาเป็น LOW
  digitalWrite(ledPin1, HIGH);


  // Connect to WiFi network
  for (uint8_t t = 4; t > 0; t--) {
    Serial.printf("[SETUP] WAIT %d...\n", t);
    Serial.flush();
    delay(1000);
  }
  WiFiMulti.addAP(ssid, pass); // ssid , password
  randomSeed(50);

  configTime(timezone, dst, "pool.ntp.org", "time.nist.gov");
  Serial.println("\nWaiting for time");
  while (!time(nullptr)) {
    Serial.print(".");
    delay(1000);
  }

}



void loop() {

  // Check if a client has connected
  if ((WiFiMulti.run() == WL_CONNECTED)) {
    duration_sensor();//ข้อมลูระยะทาง
    config_formbase_user();//ดึงข้อมูลฟิกค่าเซนเซอร์จากฐานข้อมูล
    config_formbase_status();//ดึงข้อมูลฟิกค่า status จากฐานข้อมูล

    //ตรวจอุปรกรณ์เอ๋ออ
    if (cm > 450) {
      setup_line_error();
    }

    //ถ้าระยะน้ำสูงกว่าค่าที่กำหนด เครื่องทำงาน Auto
        if ((cm <= ch1) && (userid == 65)||(cm <= ch1) &&(userid != 65)) {
          digitalWrite(ledPin1, LOW); // Pin D0 is LOW เปิดไฟ
    
          datadase_satatus_1_auto();//ลงเบสสถานะ
          setup_line() ;//ลงเบส Line
          insert_sensorToBase();//ลงเบสระดับน้ำ
    
          //เครื่องเปิดอยู่
          if (status_device == 1) {
            digitalWrite(ledPin1, LOW);//ไฟเปิด
            datadase_satatus_1_auto();//ลงเบสสถานะ
          }//end เครื่องเปิดอยู่ status_device == 1
    
          //ถ้าสถานะเป็น 0 เครื่องไม่ทำงาน
          //       if(status_device == 0) {
          //        digitalWrite(ledPin1, HIGH); // Pin D0 is LOW ปิดไฟ
          //        //datadase_satatus_0();//ลงเบสสถานะ
          //        datadase_satatus_0_auto();//ลงเบสสถานะ
          //        insert_sensorToBase();//ลงเบสระดับน้ำ
          //        //        delay(5000);
          //      }
          delay(2000);
    
        }//end auto cm <= ch1

    //น้ำต่ำกว่าที่กำหนด //auto stop process
    if ((cm >= ch1) && (userid == 65)) {
      digitalWrite(ledPin1, HIGH); // Pin D0 is LOW ปิดไฟ
      insert_sensorToBase();//ลงเบสระดับน้ำ
      datadase_satatus_0_auto();//ลงเบสสถานะ
      delay(2000);

    }//end //auto stop process

    if ((cm >= ch1) && (userid != 65)) {
      if (status_device == 1) {

        digitalWrite(ledPin1, LOW); // Pin D0 is LOW เปิดไฟ
        //datadase_satatus_1();//ลงเบสสถานะ
        datadase_satatus_1_user();//ลงเบสสถานะ
        insert_sensorToBase();//ลงเบสระดับน้ำ
        //setup_line() ;//ลงเบส Line

        //กำหนดระยะเซนเซอร์ไม่ให้ต่ำกว่าท้องร่องให้หยุดการทำงาน
        //        if ((cm >= 180) ) {
        //          digitalWrite(ledPin1, HIGH); // Pin D0 is LOW ปิดไฟ
        //          //datadase_satatus_0();//ลงเบสสถานะ
        //          datadase_satatus_0_auto();//ลงเบสสถานะ
        //          insert_sensorToBase();//ลงเบสระดับน้ำ
        //        }
        //        delay(60000);

      }//end (status_device == 1)
    }// if ((cm >= ch1) && (userid != 0)) {

    if ((cm >= ch1) && (userid != 65)) {
      if (status_device == 0) {   
          digitalWrite(ledPin1, HIGH); // Pin D0 is LOW ปิดไฟ
          insert_sensorToBase();//ลงเบสระดับน้ำ
          datadase_satatus_0_user();//ลงเบสสถานะ
        }
      }// if ((cm >= ch1) && (userid != 0)) {



    }//end WiFiMulti

  }//end loop

  void config_formbase_status() {
    // put your main code here, to run repeatedly:
    Serial.print("connecting to ");
    Serial.println(host);

    WiFiClient client;
    const int httpPort = 80;
    if (!client.connect(host, httpPort)) {
      Serial.println("connection failed");
      return;
    }
    String url = "/b_phpProject/jsonOnOff.php";    //ดึงค่าจากไฟล์ http://9arduino.nisit.net/api/json.php
    Serial.print("Requesting URL: ");
    Serial.println(url);

    client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n\r\n");
    unsigned long timeout = millis();
    while (client.available() == 0) {
      if (millis() - timeout > 5000) {
        Serial.println(">>> Client Timeout !");
        client.stop();
        return;
      }
    }
    // ในส่วนของการดึง Json โดยการดึง ตัวแปรที่ชื่อว่าตัวแปรมาใช้งาน
    // ยกตัวอย่าง ตัวแปร ch1 ค่าที่ได้จะเป็น 1 แสดงออกมา เราสามารถนำ ตัว แปร ch1 ไปใช้งานต่างๆได้เช่นการแสดงข้อความออกจอ LCD เปิดปิดไฟตามกำหนด
    if (client.find("")) {
      client.find("status_device");  //
      status_device = client.parseFloat();

      client.find("userid");  //
      userid = client.parseFloat();
    }
    Serial.print("Output status device = ");
    Serial.println(status_device);
    Serial.print("Output userid = ");
    Serial.println(userid);
    //  Serial.println();
    //  Serial.println("closing connection");
  }

  long microsecondsToCentimeters(long microseconds)
  {
    // ความเร็วเสียงในอากาศประมาณ 340 เมตร/วินาที หรือ 29 ไมโครวินาที/เซนติเมตร
    // ระยะทางที่ส่งเสียงออกไปจนเสียงสะท้อนกลับมาสามารถใช้หาระยะทางของวัตถุได้
    // เวลาที่ใช้คือ ระยะทางไปกลับ ดังนั้นระยะทางคือ ครึ่งหนึ่งของที่วัดได้
    return microseconds / 29 / 2;
  }
  void duration_sensor()
  {
    Serial.print("connecting to ");
    Serial.println(host);
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


  }
  void datadase_satatus_0() {
    HTTPClient http;

    String ur_status = "http://192.168.43.104/b_phpProject/addstatus.php?status=" + String(2) + "&level=" + String(cm) ;
    Serial.println(ur_status);
    http.begin(ur_status); //HTTP

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
  void datadase_satatus_1() {
    HTTPClient http;

    String ur_status = "http://192.168.43.104/b_phpProject/addstatus.php?status=" + String(1) + "&level=" + String(cm) ;
    Serial.println(ur_status);
    http.begin(ur_status); //HTTP

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
  void datadase_satatus_1_auto() {
    HTTPClient http;

    String ur_status = "http://192.168.43.104/b_phpProject/addstatus.php?status=" + String(1) + "&iduser=" + String(5) + "&level=" + String(cm);
    Serial.println(ur_status);
    http.begin(ur_status); //HTTP



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
  void datadase_satatus_1_user() {
    HTTPClient http;

    String ur_status = "http://192.168.43.104/b_phpProject/addstatus.php?status=" + String(1) + "&iduser=" + String(8) + "&level=" + String(cm);
    Serial.println(ur_status);
    http.begin(ur_status); //HTTP



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
  void datadase_satatus_0_user() {
    HTTPClient http;

    String ur_status = "http://192.168.43.104/b_phpProject/addstatus.php?status=" + String(0) + "&iduser=" + String(8) + "&level=" + String(cm);
    Serial.println(ur_status);
    http.begin(ur_status); //HTTP



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
  void datadase_satatus_0_auto() {
    HTTPClient http;

    String ur_status = "http://192.168.43.104/b_phpProject/addstatus.php?status=" + String(2) + "&iduser=" + String(5) + "&level=" + String(cm);
    Serial.println(ur_status);
    http.begin(ur_status); //HTTP



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
  void config_formbase_user() {
    Serial.print("connecting to ");
    Serial.println(host);

    WiFiClient client;
    const int httpPort = 80;
    if (!client.connect(host, httpPort)) {
      Serial.println("connection failed");
      return;
    }

    String url = "/b_phpProject/json.php";    //ดึงค่าจากไฟล์ http://9arduino.nisit.net/api/json.php
    Serial.print("Requesting URL: ");
    Serial.println(url);

    client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                 "Host: " + host + "\r\n" +
                 "Connection: close\r\n\r\n");
    unsigned long timeout = millis();
    while (client.available() == 0) {
      if (millis() - timeout > 5000) {
        Serial.println(">>> Client Timeout !");
        client.stop();
        return;
      }
    }
    // ในส่วนของการดึง Json โดยการดึง ตัวแปรที่ชื่อว่าตัวแปรมาใช้งาน
    // ยกตัวอย่าง ตัวแปร ch1 ค่าที่ได้จะเป็น 1 แสดงออกมา เราสามารถนำ ตัว แปร ch1 ไปใช้งานต่างๆได้เช่นการแสดงข้อความออกจอ LCD เปิดปิดไฟตามกำหนด
    if (client.find("")) {
      client.find("ch1");  //
      ch1 = client.parseFloat();
    }
    Serial.print("Output sensor frombase = ");
    Serial.println(ch1);
    Serial.println();
    Serial.println("closing connection");
  }
  void insert_sensorToBase() {
    //  insert to database

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
  }
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
  void setup_line() {
    HTTPClient http;

    cm_0 = 200 - cm;
    comment = "ระดับน้ำผิดปกติสูงขึ้น" ;
    //ถ้าค่าติดลบ ให้เซ็ตค่าเป็น 0
    if (cm_0 < 0) {
      cm_0 = 0;
      message_cm = cm_0;
      messagenoti = comment + "เหลือ : " + message_cm + " เซนติเมตร";
      Line_Notify(messagenoti);//เตือนไลน์เวลาระดับน้ำสูงผิดปกติ
    }
    else {
      message_cm = cm_0;
      messagenoti = comment + "เหลือ : " + message_cm + " เซนติเมตร";
      Line_Notify(messagenoti);//เตือนไลน์เวลาระดับน้ำสูงผิดปกติ
    }

    String url_line = "http://192.168.43.104/b_phpProject/addNotiLine.php?sensor=" + String(cm) + "&message=" + comment;
    Serial.println(url_line);
    http.begin(url_line); //HTTP



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
  void setup_line_error() {
    HTTPClient http;

    comment = "อุปกรณ์เซ็นเซอร์ผิดปกติ" ;
    //ถ้าค่าติดลบ ให้เซ็ตค่าเป็น 0
    if (cm > 450) {
      messagenoti = comment ;
      Line_Notify(messagenoti);//เตือนไลน์เวลาระดับน้ำสูงผิดปกติ
    }
    else {
      message_cm = cm_0;
      messagenoti = comment + "เหลือ : " + message_cm + " เซนติเมตร";
      Line_Notify(messagenoti);//เตือนไลน์เวลาระดับน้ำสูงผิดปกติ
    }



  }

