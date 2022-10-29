#include <Adafruit_NeoPixel.h>
#define PIN 15	 // input pin Neopixel is attached to
#define NUMPIXELS 30 // number of neopixels in strip
Adafruit_NeoPixel pixels = Adafruit_NeoPixel(NUMPIXELS, PIN, NEO_GRB + NEO_KHZ800);

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


void setup() {
  pixels.begin();
}

void loop() {
  ledStrip();
}

  