

#include <BaseDefinitions.h>
#include <BufferedPrint.h>
#include <Constellation.h>
#include <LinkedList.h>
#include <PackageDescriptor.h>

#include <ArduinoJson.h>
#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
const char* ssid = "Cc c moi bapt";           // Identifiant WiFi
const char* password = "biteaucul";  // Mot de passe WiFi
Constellation<WiFiClient> constellation("172.20.10.4", 8088, "Virtuelle", "PkgVirtuel", "123456789");
 // Broche ECHO
 
/* Constantes pour le timeout */
const unsigned long MEASURE_TIMEOUT = 25000UL; // 25ms = ~8m à 340m/s

/* Vitesse du son dans l'air en mm/us */
const float SOUND_SPEED = 340.0 / 1000;
int Laser =0;
int seuil=950;
void setup(void) {
  Serial.begin(115200);
  
  // Connect to Wifi  
  WiFi.begin(ssid,password);  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print("OUI");
  }
  // For WiFi101, wait 10 seconds for connection!
  // delay(10000);
 
  Serial.println("WiFi connected. IP: ");
  Serial.println(WiFi.localIP());

}

// Fonction loop(), appelée continuellement en boucle tant que la carte Arduino est alimentée
void loop() {
  
  // Mesure la tension sur la broche A0
  int valeur = analogRead(A0);
  
  // Envoi la mesure au PC pour affichage et attends 250ms
  Serial.println(valeur);
  if(valeur>seuil){
    constellation.pushStateObject("Presence","NON");
    }
    else{
      constellation.pushStateObject("Presence","OUI");
      }
  delay(250);
}

 
/** Fonction loop() */



