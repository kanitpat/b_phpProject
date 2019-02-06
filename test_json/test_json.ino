#include <ESP8266WiFi.h> //เป็นการเรียกใช้ Library โมดูล ESP8266
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
#include <time.h>
#include <Arduino.h>
ESP8266WiFiMulti WiFiMulti;


const char* ssid     = "Counterpan";
const char* password = "52123401";
const char* host = "192.168.43.104";  //Doamin ที่ต้องการดึงค่ามาใช้

int ch1,ch2,ch3,ch4 = 0;

void setup() {
  Serial.begin(9600);
  pinMode(D4, OUTPUT);
  delay(10);

  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);  

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

int value = 0;

void loop() {
  delay(2000);
  ++value;
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
  if(client.find("")){
      client.find("ch1");  // 
      ch1 = client.parseFloat();
     }
  Serial.print("Output = ");
  Serial.println(ch1); 
  Serial.println();
  Serial.println("closing connection");

}
