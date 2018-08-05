
//Setup voor alle tabbladen wordt uitgevoerd.
void setup() {
  Serial.begin(9600);
  nachtModus_Setup(); 
  teller_Setup();
  voetganger_Setup();
  slagboom_Setup();
  stoplicht_Setup();
  buzzer_Setup();
  verkeer_Setup();  
}
//Loopt het verkeers kruispunt.
void loop() {
  verkeer_Loop();
  if(!nachtmodus()){
    verkeersKnoppen();
  }
}
