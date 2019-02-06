#include <ESP8266WiFi.h>
#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
#include <time.h>
const char* host = "192.168.43.104";  //Doamin ที่ต้องการดึงค่ามาใช้
ESP8266WiFiMulti WiFiMulti;
#include <time.h>
int timezone = 7 * 3600;

const char* ssid = "Counterpan";
const char* pass = "52123401";
int dst = 0;

int ledPin1 = D1; // ขา D1


int relay = 0;
int status_device = 0;


WiFiServer server(80);

void setup() {
  Serial.begin(9600);
  delay(100);

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


void config_formbase() {
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
  }
  Serial.print("Output = ");
  Serial.println(status_device);
  //  Serial.println();
  //  Serial.println("closing connection");
}


void loop() {

  // Check if a client has connected
  if ((WiFiMulti.run() == WL_CONNECTED)) {
  
    config_formbase();

    if (status_device == 1) {
      digitalWrite(ledPin1, LOW);
      //    relay = 1;
    } else {
      digitalWrite(ledPin1, HIGH); // Pin D0 is LOW
    }

 
  }
}
