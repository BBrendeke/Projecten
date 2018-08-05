//Stoplicht pinnen.
const int lichtPinnen[] = {1,2,3,4,5,6};
//Stoplicht setup.
void stoplicht_Setup(){
  for(int i = 0; i < 6; i++){
    pinMode(i,OUTPUT);
  }
}

//Zet groen aan voor de gewenste kant.
void stoplicht_Groen_Aan(int kant){
  if(kant == 1){
    digitalWrite(lichtPinnen[0],HIGH);
  }else if(kant == 2){
    digitalWrite(lichtPinnen[3],HIGH);
  }
}

//Zet groen uit voor de gewenste kant.
void stoplicht_Groen_Uit(int kant){
  if(kant == 1){
    digitalWrite(lichtPinnen[0],LOW);
  }else if(kant == 2){
    digitalWrite(lichtPinnen[3],LOW);
  }
}
//Zet oranje aan voor gewenste kant.
void stoplicht_Oranje_Aan(int kant){
  if(kant == 1){
    digitalWrite(lichtPinnen[1],HIGH);
  }else if(kant == 2){
    digitalWrite(lichtPinnen[4],HIGH);
  }
}

//Zet oranje uit voor de gewenste kant.
void stoplicht_Oranje_Uit(int kant){
  if(kant == 1){
    digitalWrite(lichtPinnen[1],LOW);
  }else if(kant == 2){
    digitalWrite(lichtPinnen[4],LOW);
  }
}

//Zet rood aan voor de gewenste kant.
void stoplicht_Rood_Aan(int kant){
  if(kant == 1){
    digitalWrite(lichtPinnen[2],HIGH);
  }else if(kant == 2){
    digitalWrite(lichtPinnen[5],HIGH);
  }
}

//Zet rood uit voor de gewenste kant.
void stoplicht_Rood_Uit(int kant){
  if(kant == 1){
    digitalWrite(lichtPinnen[2],LOW);
  }else if(kant == 2){
    digitalWrite(lichtPinnen[5],LOW);
  }
}

