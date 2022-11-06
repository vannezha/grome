#include <ArduinoJson.h>
#include <ArduinoJson.hpp>

#include <HTTPClient.h>

#include <WiFi.h>
#include <WiFiMulti.h>

#include <Adafruit_NeoPixel.h>
#define PIN 15	 // input pin Neopixel is attached to
#define NUMPIXELS 30 // number of neopixels in strip
Adafruit_NeoPixel pixels = Adafruit_NeoPixel(NUMPIXELS, PIN, NEO_GRB + NEO_KHZ800);

WiFiMulti wifiMulti;

String urlToken = "http://35.229.251.21/api/login?username=vannyezha&password=password&guid=grome800000001";
String urlEndpoint = "http://35.229.251.21/api/vannyezha/grome800000001";
String token;
String Token= "Bearer ";

// void makeConnection(String ssid, String password){
//   for(int i =0; i<100;i++){
//     String num = i; 
//     ssid += char(i);
//     char * newssid = new char [ssid.length()+1];
//     strcpy(newssid, ssid.c_str());
//     char * newpassword = new char [password.length()+1];
//     strcpy(newpassword, password.c_str());
//     wifiMulti.addAP(newssid, newpassword);
//     Serial.println(newssid);
//     Serial.println(newpassword);
//   }
// }

void ledStrip(int r = -1, int g = -1, int b = -1){
  if(r == -1 && g == -1 && b == -1){
    r = random(0, 255);
    g = random(0, 255);
    b = random(0, 255);
  }
  for (int i=0; i < NUMPIXELS; i++) {
    pixels.setPixelColor(i, pixels.Color(r, g, b));
    pixels.show();
    delay(100);
  }
}

String getToken(){
  if(wifiMulti.run() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(urlToken);
    http.addHeader("Content-Type", "x-www-form-urlencoded");
    http.addHeader("Host", "35.229.251.21");
    // http.addHeader("Postman-Token", "35.229.251.21");
    int httpResponseCode = http.POST("");
    if(httpResponseCode>0){
      
        String response = http.getString();  //Get the response to the request
        Serial.println(response);           //Print request answer

        DynamicJsonDocument doc(1024);
        deserializeJson(doc, response);
        JsonObject obj = doc.as<JsonObject>();
        String localtoken = obj[String("token")];
        Serial.println(token);
        http.end();
        return localtoken;
      
    }else{
      
        Serial.print("Error on sending POST: ");
        Serial.println(httpResponseCode);
        return "779|zlh9VrkEgkXPCKNe9K95lufRpcWlfNfR7qJa8g8N";
      
    }
  }else{
    Serial.println("Failed connect to wifi bang, 1");
    return "780|8Jl2IBFKa548vA9AbKUhTreJeXO3Tu9WWxvNRnaK";
  }
  // delay(1000);
}

void setup()
{
    Serial.begin(9600);
    wifiMulti.addAP("pembesariman8", "12345678");
    wifiMulti.addAP("pembesariman9", "12345678");
    token = getToken();
}

void loop()
{
  Serial.print("Token = ");
  Serial.println(Token+token);
  if(wifiMulti.run() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(urlEndpoint);
    http.addHeader("Content-Type", "x-www-form-urlencoded");
    http.addHeader("Host", "35.229.251.21");
    http.addHeader("Authorization", Token+token);
    // http.addHeader("Postman-Token", "35.229.251.21");
    int httpResponseCode = http.POST("");
    if(httpResponseCode>0){
      
        String response = http.getString();  //Get the response to the request
        Serial.println(response);           //Print request answer

        DynamicJsonDocument doc(1024);
        deserializeJson(doc, response);
        JsonObject obj = doc.as<JsonObject>();
        int Rlight_intensity = obj[String("Rlight_intensity")];
        int Glight_intensity = obj[String("Glight_intensity")];
        int Blight_intensity = obj[String("Blight_intensity")];
        Serial.println(Rlight_intensity);
        Serial.println(Glight_intensity);
        Serial.println(Blight_intensity);
        http.end();
        ledStrip(Rlight_intensity, Glight_intensity, Blight_intensity);
        // return Rlight_intensity, Glight_intensity, Blight_intensity;
      
    }else{
      
        Serial.print("Error on sending POST: ");
        Serial.println(httpResponseCode);
        ledStrip();
        // return 0,0,0
      
    }
  }else{
    Serial.println("Failed connect to wifi bang, 2");
    ledStrip();
    // return 0,0,0
  }
  delay(1000);
}


