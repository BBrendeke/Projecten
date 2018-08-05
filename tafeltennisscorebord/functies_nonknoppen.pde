
void spelers() {
  fill(0);
  textAlign(CENTER, CENTER);
  textSize(textGroote);
  text("Speler 1", bordjesX[0], bordjesY);
  text("Speler 2", bordjesX[2], bordjesY);
}


void sets() {
  int verschil = score1 - score2;
  int punten = 0;
  if (verschil >= 2) {
    punten = 1;
  } else if (verschil <=-2) {
    punten = 1;
  }
  if (punten == 1) {
    if (verOud) {
      if (score1 >= 21) {
        set1 = set1 + 1;
        sets = sets + 1;
        score1 = 0;
        score2 = 0;
        wissel = !wissel;
      } else if (score2 >= 21) {
        set2 = set2 + 1;
        sets = sets + 1;
        score1 = 0;
        score2 = 0;
        wissel = !wissel;
      }
    } else if (verNieuw) {
      if (score1 >= 11) {
        set1 = set1 + 1;
        sets = sets +1;
        score1 = 0;
        score2 = 0;
        wissel = !wissel;        
      } else if (score2 >= 11) {
        set2 = set2 + 1;
        sets = sets + 1;
        score1 = 0;
        score2 = 0;
        wissel = !wissel;
      }
    }
  }
  fill(0);
  textAlign(CENTER, TOP);
  textSize(textGroote);
  text(set1, bordjesX[0], bordjesY * 2);
  text(set2, bordjesX[2], bordjesY * 2);
}


void puntenTeller() {
  fill(255);
  for (int i = 0; i < puntenX.length; i++) {
    rectMode(CENTER);  
    rect(puntenX[i], puntenY, knopBreedtePunten, knopHoogtePunten);//het bord moet even groot als de score knoppen.
  } 
  textSize(textGroote);
  textAlign(CENTER, CENTER);
  fill(0);
  text(score1, puntenX[0], puntenY);
  text(score2, puntenX[1], puntenY);

  if (wissel) {
    puntenX[0] = puntenX1;
    puntenX[1] = puntenX2;
  }
}

void bordjes() {
  fill(255);
  for (int i = 0; i < bordjesX.length; i++) {
    rectMode(CENTER);
    rect(bordjesX[i], bordjesY, bordjesBreedte, knopHoogtePunten); // de blokjes moeten zelfde hoogte als de score knoppen.
    rect(bordjesX[i], bordjesY * 2.5, bordjesBreedte, knopHoogtePunten);
  }
  fill(0);
  textAlign(CENTER, TOP);
  textSize(textGroote);
  text("Sets Win", bordjesX[1], bordjesY * 2);
}

void setScoreBordjes() {


  fill(255);  
  for (int i = 0; i < setScoreX.length; i++) {
    for (int j = 0; j < setScoreY.length; j++) {
      rectMode(CENTER);
      rect(setScoreX[i], setScoreY[j], setScoreBreedte, setScoreHoogte);
    }
  }
}

void setScore() {

  float setWissel1 = setScoreX[1];
  float setWissel2 = setScoreX[0];
 
  if (sets == 0 && score1 <= 11) {
  } else if (sets == 2) {
  }
  if (wissel) {
    setScoreX[0] = setWissel1;
    setScoreX[1] = setWissel2;
  } else {

    fill(0);
    textAlign(CENTER, TOP);
    textSize(textGroote);         
    text(ss1[0], setScoreX[0], setScoreY[0]);
    text(ss1[1], setScoreX[0], setScoreY[1]);
    text(ss1[2], setScoreX[0], setScoreY[2]);
    text(ss1[3], setScoreX[0], setScoreY[3]);
    text(ss1[4], setScoreX[0], setScoreY[4]);
    text(ss1[5], setScoreX[0], setScoreY[5]);
    text(ss1[6], setScoreX[0], setScoreY[6]);
    text(ss2[0], setScoreX[1], setScoreY[0]);
    text(ss2[1], setScoreX[1], setScoreY[1]);
    text(ss2[2], setScoreX[1], setScoreY[2]);
    text(ss2[3], setScoreX[1], setScoreY[3]);
    text(ss2[4], setScoreX[1], setScoreY[4]);
    text(ss2[5], setScoreX[1], setScoreY[5]);
    text(ss2[6], setScoreX[1], setScoreY[6]);
  }
}





void winScherm() {
  

  if (best3 && sets == 3) {
    spelIsGestart = !spelIsGestart;
    if (set1 >= 2) {
      win1 = true;
    } else if (set2 >= 2) {
      win2 = true;
    }
  } else if (best5 && sets == 5) {
    spelIsGestart = !spelIsGestart;
    if (set1 >= 3) {
      win1 = true;
    }
  } else if (set2 >= 3) {
    win2 = true;
  } else if (best7 && sets == 7) {
    spelIsGestart = !spelIsGestart;
    if (set1 >= 4) {
      win1 = true;
    } else if (set2 >= 4) {
      win2 = true;
    }
  }
}