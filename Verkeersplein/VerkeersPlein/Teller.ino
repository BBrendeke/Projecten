
//Pinnen voor het shiftregister
const int dataPin = 9;
const int latchPin = 8;
const int clockPin = 10;

//Setup van de teller van het stoplicht van voetgangers.
void teller_Setup(){
  pinMode(dataPin, OUTPUT);
  pinMode(latchPin, OUTPUT);
  pinMode(clockPin, OUTPUT);
  
}

//Stuurt het juiste nummer naar het shiftregister in bits.
void shiftOutBits(byte bits) {

  digitalWrite(latchPin, LOW);
  shiftOut(dataPin, clockPin, LSBFIRST, bits);
  digitalWrite(latchPin, HIGH);
}

//Veranderd een nummer in bits voor het shiftregister.
byte NumToBits(int someNumber) {
  switch (someNumber) {
    case 0:
      return B11111100;
      break;
    case 1:
      return B01100000;
      break;
    case 2:
      return B11011010;
      break;
    case 3:
      return B11110010;
      break;
    case 4:
      return B01100110;
      break;
    case 5:
      return B10110110;
      break;
    case 6:
      return B10111110;
      break;
    default :
      return B00000011; // Error
      break;
  }
}
