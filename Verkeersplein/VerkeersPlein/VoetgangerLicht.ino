//Houdt tijd bij voor de Teller.
unsigned long previousMillisVoetgangerTeller;
//Het interval van de teller, zodat hij goed aftelt.
const int tellerInterval = 1000;
//Verteld waar de teller moet starten.
int nummer;

//Setup van voetganger.
void voetganger_Setup(){
  previousMillisVoetgangerTeller = millis();  
}
//Zet het stoplicht voor voetganger op groen.
void voetganger_Groen(){
  byte groen = B01010100;
  shiftOutBits(groen);
}
//Zet het stoplicht op rood voor voetganger.
void voetganger_Rood(){
  byte rood = B10010010;
  shiftOutBits(rood);
}
//Schakeld het stoplicht van voetganger in nachtmodus.
void voetganger_NachtModus(){
  byte nachtModus = B01101100;
  shiftOutBits(nachtModus);
}
//Telt af hoelang de voetgangers mogen lopen.
void voetganger_Aftellen(){
  nummer = 6;
  if (millis() - previousMillisVoetgangerTeller >= tellerInterval) {
    previousMillisVoetgangerTeller = millis();
    buzzer_Aan();
    byte bits = NumToBits(nummer);
    shiftOutBits(bits);
    nummer--; 
    Serial.println(nummer);
  }
}

