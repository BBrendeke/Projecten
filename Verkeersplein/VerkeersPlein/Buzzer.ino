//Buzzer pin
const int buzzerPin = A3;
//Houdt voorgaande millis bij voor tijd berekenen.
unsigned long previousMillisBuzzer;
//Het interval van de buzzer.
const int buzzerInterval = 500;
//Geeft aan of de buzzer aanstaat.
bool buzzerAan;
//Setup van buzzer.
void buzzer_Setup(){
  pinMode(buzzerPin, OUTPUT);
  buzzerAan = false;
}
//Zet de buzzer aan. En houdt pauzes bij.
void buzzer_Aan(){
  if(buzzerAan){
    if(millis() - previousMillisBuzzer >= buzzerInterval){
      previousMillisBuzzer = millis();
      //analogWrite(buzzerPin, 150);
      Serial.println("buzzer aan");
      buzzerAan = false;
    }
  }else{
      analogWrite(buzzerPin, 0);
      buzzerAan = true;
      Serial.println("buzzer pauze");
    }
}
//Zet de buzzer uit.
void buzzer_Uit(){
  analogWrite(buzzerPin, 0);
  buzzerAan = false;
  Serial.println("buzzer uit");
}

