#include <Adafruit_NeoPixel.h>
#define PIN 15	 // Pin data yang digunakan neopixel
#define NUMPIXELS 30 // jumlah neopixel yang digunakan
Adafruit_NeoPixel pixels = Adafruit_NeoPixel(NUMPIXELS, PIN, NEO_GRB + NEO_KHZ800);


// water level
// const int pinSensor = 17;
// #define pinSensor 2
// const int RELAY_SOIL = 1;

// const int SOIL = 0;
#define SOIL 4

#define BLYNK_TEMPLATE_ID "TMPLEBdmy-W1"
#define BLYNK_DEVICE_NAME "GromeTemplateESP32"

#define BLYNK_FIRMWARE_VERSION        "0.1.0"

#define BLYNK_PRINT Serial
//#define BLYNK_DEBUG

#define APP_DEBUG

// Uncomment your board, or configure a custom board in Settings.h
//#define USE_WROVER_BOARD
//#define USE_TTGO_T7
// #define USE_ESP32C3_DEV_MODULE
#define USE_ESP32S2_DEV_KIT


// dht11
#include "DHT.h"
#define DHTPIN 19
#define DHTTYPE DHT11
#define RELAY_DHT  5
DHT dht(DHTPIN, DHTTYPE);

#include "BlynkEdgent.h"

// inisiasi variabel yang digunakan ledStrip
int red;
int green;
int blue;

// soil measurement
int water;
// int waterLevel;
// int waterValue;
// waterlevel
// int nilaiSensor = 0 ;
// int hasil = 0 ;
// double tinggiAir;

double set_airHumidity;
double set_soilHumidity;
double set_temperature;

double get_airHumidity;
double get_soilHumidity;
double get_temperature;
// int get_waterLevel;

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
double SoilMeasurement(){
  double water = digitalRead(SOIL);  // reading the coming signal from the soil sensor

  // if(water == HIGH) // if water level is full then cut the relay
  // {
  // digitalWrite(3,LOW); // low is to cut the relay
  // }
  // else
  // {
  // digitalWrite(3,HIGH); //high to continue proving signal and water supply
  // }
  // Serial.println(water);
  return water;
}

// int waterLevel(){
  // int nilaiSensor = analogRead(2);
  // int hasil = map(nilaiSensor, 0, 1023, 0, 255);


  // Serial.print("Nilai Sensor=");
  // Serial.print(nilaiSensor);
  // Serial.print("\t Tinggi Air = ");
  // Serial.print(hasil);

  // int tinggiAir = hasil*4/255;
  // Serial.print("\t Tinggi Air = ");
  // Serial.print(tinggiAir);
  // delay(5000);
  // return tinggiAir;
  // return nilaiSensor;
// }
double readAairHumidity(){
  double h = dht.readHumidity();

  if (isnan(h) ){
    Serial.println("Pembacaan gagal");
    return 0;
    }
    // Serial.print("Kelembapan");
    // Serial.print(h);
  return h;
  }

double readTemmperature(double setPoint){
  float t = dht.readTemperature();

  if (isnan(t) ){
    Serial.println("Pembacaan gagal");
    return 0;
    }
    // Serial.print("Suhu: ");
    // Serial.print(t);
    // Serial.print(" * C ");

  //    if (isnan(t)) {
  //   Serial.println("Failed to read from DHT sensor!");
  // } else {
  //   if(t  > setPoint){
  //     Serial.println("The fan is turned on");
  //     digitalWrite(RELAY_DHT, HIGH); // turn on
  //   } else if(t < setPoint-2){
  //     Serial.println("The fan is turned off");
  //     digitalWrite(RELAY_DHT, HIGH); // turn on
  //   }
  // }
  return t;
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
  // delay(100);

// harus dibenahi
  // pinMode(RELAY_SOIL,OUTPUT); //output pin for relay board, this will sent signal to the relay
  pinMode(SOIL,INPUT); //input pin coming from soil sensor
  pinMode(2,INPUT);
  // dht11
  dht.begin();

  BlynkEdgent.begin();
}

void loop() {
  BlynkEdgent.run();
  get_airHumidity = readAairHumidity();
  get_soilHumidity = SoilMeasurement();
  get_temperature = readTemmperature(set_temperature);
  int waterValue = analogRead(33);
  // get_waterLevel = waterLevel();


  // pembacaan sensor airHumidity ditampilkan ke blynk 
  Blynk.virtualWrite(V6, get_airHumidity);
  // pembacaan sensor soilHumidity ditampilkan ke blynk
  Blynk.virtualWrite(V7, get_soilHumidity);
  // pembacaan sensor temperature ditampilkan ke blynk
  Blynk.virtualWrite(V8, get_temperature);
  // pembacaan sensor water level ditampilkan ke blynk
  Blynk.virtualWrite(V9, waterValue);

  // Serial.println("waterLevel");
  // Serial.println(123456);
  Serial.println(waterValue);

  // Serial.println(get_waterLevel);

  // pembacaan sensor airHumidity ditampilkan ke blynk 
  // Blynk.virtualWrite(V6, set_airHumidity);
  // pembacaan sensor soilHumidity ditampilkan ke blynk
  // Blynk.virtualWrite(V7, set_soilHumidity);
  // pembacaan sensor temperature ditampilkan ke blynk
  // Blynk.virtualWrite(V8, set_temperature);

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

