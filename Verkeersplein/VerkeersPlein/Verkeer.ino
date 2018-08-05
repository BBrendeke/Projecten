//Knoppen
const int autoLinksPin = 11;
const int autoRechtsPin = 12;
const int voetgangerPin = 13;
//States
const int GEEN_VERKEER = 0;
const int VERKEER_LINKS = 1;
const int VERKEER_RECHTS = 2;
const int VOETGANGER = 3;
const int SLAGBOOM_OMHOOG = 4;
const int SLAGBOOM_OMLAAG = 5;
const int NACHTMODUS = 6;
//Booleans voor bepalen van volgende actie
bool voetganger;
bool autoLinks;
bool autoRechts;
//Huidige state
int huidigeState;
//Intervals
const int dodeTijd = 2000;
const int voetgangerGroenInterval = 500;
const int voetgangerTellenInterval = 7000; //Aftellen plus nog wat extra tijd om over te steken.
const int autoInterval = 10000;
const int autoOranjeInterval = 2000;
const int nachtInterval = 1000;
//Tijd voor berekeningen met tijd.
unsigned long previousMillis;
//Setup van verkeer.
void verkeer_Setup(){
  huidigeState = GEEN_VERKEER;
  //Zet alles op rood/dicht
  voetganger_Rood();
  stoplicht_Groen_Uit(1);
  stoplicht_Groen_Uit(2);
  stoplicht_Oranje_Uit(1);
  stoplicht_Oranje_Uit(2);
  stoplicht_Rood_Aan(1);
  stoplicht_Rood_Aan(2);
  //Zet begin positie op geen verkeer.
  voetganger = false;
  autoLinks = false;
  autoRechts = false;
  //Knoppen 
  pinMode(autoLinksPin, INPUT);
  pinMode(autoRechtsPin, INPUT);
  pinMode(voetgangerPin, INPUT);
  
}
//De statemachine die wisseld tussen de states.
void verkeer_Loop(){
  
  switch(huidigeState){
    case GEEN_VERKEER:
    
      stoplicht_Groen_Uit(1);
      stoplicht_Groen_Uit(2);
      stoplicht_Oranje_Uit(1);
      stoplicht_Oranje_Uit(2);
      stoplicht_Rood_Aan(1);
      stoplicht_Rood_Aan(2);
      //Activeerd nachtmodus.
      if(nachtmodus()){
        huidigeState = NACHTMODUS;
      }
      //Bepaald wie er mag rijden.
      Serial.println("test");      
      if(millis() - previousMillis >= dodeTijd){
       previousMillis = millis();        
       if(voetganger){
        huidigeState = SLAGBOOM_OMHOOG;     
       }else if(autoLinks){
        huidigeState = VERKEER_LINKS;
       }else if(autoRechts){
        huidigeState = VERKEER_RECHTS;
       }
      }
     break;
    //Verkeer van links mag rijden.
    case VERKEER_LINKS:
      stoplicht_Rood_Uit(1);
      stoplicht_Groen_Aan(1);
      if(millis() - previousMillis >= autoInterval){
        stoplicht_Groen_Uit(1);
        stoplicht_Oranje_Aan(1);
        previousMillis = millis();
        if(millis() - previousMillis >= autoOranjeInterval){
          previousMillis = millis();
          stoplicht_Oranje_Uit(1);
          stoplicht_Rood_Aan(1);
          huidigeState = GEEN_VERKEER;
        }
      }
      break;
    //Verkeer van rechts mag rijden.
    case VERKEER_RECHTS:
      stoplicht_Rood_Uit(2);
      stoplicht_Groen_Aan(2);
      if(millis() - previousMillis >= autoInterval){
        stoplicht_Groen_Uit(2);
        stoplicht_Oranje_Aan(2);
        if(millis() - previousMillis >= autoOranjeInterval){
          previousMillis = millis();
          stoplicht_Oranje_Uit(2);
          stoplicht_Rood_Aan(2);
          huidigeState = GEEN_VERKEER;
        }
      }
      break;
    //Voetgangers mogen lopen.
    case VOETGANGER:
      voetganger_Groen();
      if(millis() - previousMillis >= voetgangerGroenInterval){
        voetganger_Aftellen();     
        if(millis() - previousMillis >= voetgangerTellenInterval){
          buzzer_Uit();
          huidigeState = SLAGBOOM_OMLAAG;
        }
      }      
      break;
    //Doet de slagboom omhoog voor de voetgangers.
    case SLAGBOOM_OMHOOG:
      slagboom_Omhoog();
      if(slagboom_Boven()){
        previousMillis = millis();
        huidigeState = VOETGANGER;
      }
      break;
    //Doet de slagboom omlaag voor de voetgangers.
    case SLAGBOOM_OMLAAG:
      slagboom_Omlaag();
      if(slagboom_Beneden()){
        previousMillis = millis();
        huidigeState = GEEN_VERKEER;
      }
      break;
    //Zet het verkeersplein in nachtmodus.
    case NACHTMODUS:
      slagboom_Omhoog();
      stoplicht_Oranje_Aan(1);
      stoplicht_Oranje_Aan(2);
      if(millis() - previousMillis >= nachtInterval){
        previousMillis = millis();
        stoplicht_Oranje_Uit(1);
        stoplicht_Oranje_Uit(2);
      }
      voetganger_NachtModus();
      Serial.println("nacht");
      if(!nachtmodus()){
         slagboom_Omlaag();
         stoplicht_Oranje_Uit(1);
         stoplicht_Oranje_Uit(2);
         stoplicht_Rood_Aan(1);
         stoplicht_Rood_Aan(2);
         huidigeState = GEEN_VERKEER;
      }
      break;
  }
}

//Houdt bij wie er staat te wachten.
void verkeersKnoppen(){
  int stateAutoLinks = digitalRead(autoLinksPin);
  int stateAutoRechts = digitalRead(autoRechtsPin);
  int stateVoetganger = digitalRead(voetgangerPin);

  if(stateAutoLinks == LOW){
    autoLinks = true;
  }
  if(stateAutoRechts == LOW){
    autoRechts = true;
  }
  if(stateVoetganger == LOW){
    voetganger = true;
  }
}

