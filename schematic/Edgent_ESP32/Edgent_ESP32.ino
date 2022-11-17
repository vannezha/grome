#include <Adafruit_NeoPixel.h>
#define PIN 15	 // Pin data yang digunakan neopixel
#define NUMPIXELS 30 // jumlah neopixel yang digunakan
Adafruit_NeoPixel pixels = Adafruit_NeoPixel(NUMPIXELS, PIN, NEO_GRB + NEO_KHZ800);

#define BLYNK_TEMPLATE_ID "TMPLEBdmy-W1"
#define BLYNK_DEVICE_NAME "GromeTemplate"

#define BLYNK_FIRMWARE_VERSION        "0.1.0"

#define BLYNK_PRINT Serial
//#define BLYNK_DEBUG

#define APP_DEBUG

// Uncomment your board, or configure a custom board in Settings.h
//#define USE_WROVER_BOARD
//#define USE_TTGO_T7
// #define USE_ESP32C3_DEV_MODULE
#define USE_ESP32S2_DEV_KIT

#include "BlynkEdgent.h"

// inisiasi variabel yang digunakan ledStrip
int red;
int green;
int blue;

double set_airHumidity;
double set_soilHumidity;
double set_temperature;

double get_airHumidity;
double get_soilHumidity;
double get_temperature;

void ledStrip(int r = -1, int g = -1, int b = -1){
  if(r == -1 && g == -1 && b == -1){
    r = random(0, 255);
    g = random(0, 255);
    b = random(0, 255);
  }
  for (int i=0; i < NUMPIXELS; i++) {
    pixels.setPixelColor(i, pixels.Color(r, g, b));
    pixels.show();
    // delay(100);
  }
}

// mengambil data dari virtual pin blynk (v0) dan mengcasting nilainya menjadi integer lalu memasukannya ke variable red (setpoint red)
BLYNK_WRITE(V0){
  red = param.asInt();
}
// mengambil data dari virtual pin blynk (v1) dan mengcasting nilainya menjadi integer lalu memasukannya ke variable green (setpoint green)
BLYNK_WRITE(V1){
  green = param.asInt();
}
// mengambil data dari virtual pin blynk (v2) dan mengcasting nilainya menjadi integer lalu memasukannya ke variable blue (setpoint blue)
BLYNK_WRITE(V2){
  blue = param.asInt();
}
// setpoint airHumidity
BLYNK_WRITE(V3){
  set_airHumidity = param.asDouble();
}
// setpoint soilHumidity
BLYNK_WRITE(V4){
  set_soilHumidity = param.asDouble();
}
// setpoint temperature
BLYNK_WRITE(V5){
  set_temperature = param.asDouble();
}

void setup()
{
  Serial.begin(9600);
  delay(100);

  BlynkEdgent.begin();
}

void loop() {
  BlynkEdgent.run();

  // pembacaan sensor airHumidity ditampilkan ke blynk 
  Blynk.virtualWrite(V6, set_airHumidity);
  // pembacaan sensor soilHumidity ditampilkan ke blynk
  Blynk.virtualWrite(V7, set_soilHumidity);
  // pembacaan sensor temperature ditampilkan ke blynk
  Blynk.virtualWrite(V8, set_temperature);

  // mencetak nilai rgb ke serial monitor (boleh dihapus)
  // Serial.print(red);
  // Serial.print(",");
  
  // Serial.print(green);
  // Serial.print(",");
  
  // Serial.print(blue);
  // Serial.print("\n");

  // menyalakan led strip sesuai parameter rgb dari blynk
  ledStrip(red,green,blue);
  
}

