#include <Servo.h>
//Servo aanmaken.
Servo servo;
//Servo pin.
const int slagboomPin = A4;
//Servo interval.
const int servoInterval = 15;
//Kijkt waar de slagboom is.
bool slagboomBoven;
bool slagboomBeneden;
//Houdt de vorige millis vast van servo.
unsigned long previousMillisServo;
//Houdt de positie bij.
int pos;
//Setup van slagboom.
void slagboom_Setup(){
  previousMillisServo = millis();
  slagboomBoven = false;
  slagboomBeneden = true;
  pos = 0;
  servo.attach(slagboomPin);
}
//Zet de slagboom omhoog.
void slagboom_Omhoog(){
  slagboomBeneden = false;
  if(pos < 90){
    previousMillisServo = millis();     
    if(millis() - previousMillisServo > servoInterval){      
      servo.write(pos);
      pos++;
    }
  }slagboomBoven = true;
}
//Zet de slagboom omlaag.
void slagboom_Omlaag(){
  slagboomBoven = false;
  if(pos > 0){
    previousMillisServo = millis();     
    if(millis() - previousMillisServo > servoInterval){      
      servo.write(pos);
      pos--;
    }
  }slagboomBeneden = true;
}
//Returned slagboomBoven.
bool slagboom_Boven(){
  return slagboomBoven;
}
//Returned slagboomBeneden.
bool slagboom_Beneden(){
  return slagboomBeneden;
}
