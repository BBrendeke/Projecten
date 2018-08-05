//Licht sensor pin.
const int lichtSensor = A5;
//Waarde die de sensor returnt.
int lichtWaarde;
//Geeft aan of het nacht is.
bool nacht;

//Setup van nacht modus.
void nachtModus_Setup(){
  pinMode(lichtSensor, INPUT);
  nacht = false;
  lichtWaarde = analogRead(lichtSensor);
}
//Kijkt of het nacht is.
bool nachtmodus(){
  if(lichtWaarde < 100){
    return true;
  }else{
    return false;
  }
}

