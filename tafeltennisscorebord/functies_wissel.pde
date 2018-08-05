
void kantWissel() {

  float locatieWisselY = bordjesY * 4;

  fill(255);
  rectMode(CENTER);
  rect(bordjesX[1], locatieWisselY, bordjesBreedte, knopHoogtePunten);

  if (verOud) {
    if (best3 && sets == 2) {
      if (score1 == 10) {
        fill(0);
        textAlign(CENTER, CENTER);
        textSize(textGroote);
        text("wissel kant", bordjesX[1], locatieWisselY);
        if (wissel == false) {
          wissel = !wissel;
        }
      } else if (score2 == 10) {
        fill(0);
        textAlign(CENTER, CENTER);
        textSize(textGroote);
        text("wissel kant", bordjesX[1], locatieWisselY);
        if (wissel == false) {
          wissel = !wissel;
        }
      }
    } else if (best5 && sets == 4) {
      if (score1 == 10) {
        fill(0);
        textAlign(CENTER, CENTER);
        textSize(textGroote);
        text("wissel kant", bordjesX[1], locatieWisselY);
        if (wissel == false) {
          wissel = !wissel;
        }
      } else if (score2 == 10) {
        fill(0);
        textAlign(CENTER, CENTER);
        textSize(textGroote);
        text("wissel kant", bordjesX[1], locatieWisselY);
        if (wissel == false) {
          wissel = !wissel;
        }
      }
    } else if (best7 && sets == 6) {
      if (score1 == 10) {
        fill(0);
        textAlign(CENTER, CENTER);
        textSize(textGroote);
        text("wissel kant", bordjesX[1], locatieWisselY);
        if (wissel == false) {
          wissel = !wissel;
        }
      } else if (score2 == 10) {
        fill(0);
        textAlign(CENTER, CENTER);
        textSize(textGroote);
        text("wissel kant", bordjesX[1], locatieWisselY);
        if (wissel == false) {
          wissel = !wissel;
        }
      }
    }
  } else if (verNieuw) {
    if (best3 && sets == 2) {
      if (score1 == 5) {
        fill(0);
        textAlign(CENTER, CENTER);
        textSize(textGroote);
        text("wissel kant", bordjesX[1], locatieWisselY);
        if (wissel == false) {
          wissel = !wissel;
        }
      } else if (score2 == 5) {
        fill(0);
        textAlign(CENTER, CENTER);
        textSize(textGroote);
        text("wissel kant", bordjesX[1], locatieWisselY);
        if (wissel == false) {
          wissel = !wissel;
        }
      }
    } else if (best5 && sets == 4) {
      if (score1 == 5) {
        fill(0);
        textAlign(CENTER, CENTER);
        textSize(textGroote);
        text("wissel kant", bordjesX[1], knopHoogtePunten);
        if (wissel == false) {
          wissel = !wissel;
        }
      } else if (score2 == 5) {
        fill(0);
        textAlign(CENTER, CENTER);
        textSize(textGroote);
        text("wissel kant", bordjesX[1], locatieWisselY);
        if (wissel == false) {
          wissel = !wissel;
        }
      }
    } else if (best7 && sets == 6) {
      if (score1 == 5) {
        fill(0);
        textAlign(CENTER, CENTER);
        textSize(textGroote);
        text("wissel kant", bordjesX[1], locatieWisselY);
        if (wissel == false) {
          wissel = !wissel;
        }
      } else if (score2 == 5) {
        fill(0);
        textAlign(CENTER, CENTER);
        textSize(textGroote);
        text("wissel kant", bordjesX[1], locatieWisselY);
        if (wissel == false) {
          wissel = !wissel;
        }
      }
    }
  }
  if (wissel) {
    bordjesX[2] = wissel1;
    bordjesX[0] = wissel2;
  }
}

void servWissel() {
  if (serv) {
    fill(0);
    textAlign(CENTER, CENTER);
    textSize(textGroote);
    text("Speler1", bordjesX[1], knopHoogtePunten);
  } else if (serv == false) {
    fill(0);
    textAlign(CENTER, CENTER);
    textSize(textGroote);
    text("Speler2", bordjesX[1], knopHoogtePunten);
  }
}

void serv() {
  int score = 0;
  if (verOud) {
    if (score1 > 21) {
      score = 1;
    } else if (score2 > 21) {
      score = 1;
    }else if(score1 <= 21) {
      score = 0;
    }else if(score2 <= 21){
      score = 0;
    }

    if (score == 0) {
      if (score1 == 4) {
        serv = !serv;
      } else if (score1 == 9) {
        serv = !serv;
      } else if (score1 == 14) {
        serv = !serv;
      } else if (score1 == 19) {
        serv = !serv;
      } else if (score2 == 4) {
        serv = !serv;
      } else if (score2 == 9) {
        serv = !serv;
      } else if (score2 == 14) {
        serv = !serv;
      } else if (score2 == 19) {
        serv = !serv;
      }
    }
  } else if (verNieuw) {
    if (score1 > 11) {
      score = 1;
    } else if (score2 > 11) {
      score = 1;
    }else if (score1 <= 11) {
      score = 0;
    } else if (score2 <= 11) {
      score = 0;
    }

    if (score == 0) {
      if (score1 == 1) {
        serv = !serv;
      } else if (score1 == 3) {
        serv = !serv;
      } else if (score1 == 5) {
        serv = !serv;
      } else if (score1 == 7) {
        serv = !serv;
      } else if (score1 == 9) {
        serv = !serv;
      } else if (score2 == 1) {
        serv = !serv;
      } else if (score2 == 3) {
        serv = !serv;
      } else if (score2 == 5) {
        serv = !serv;
      } else if (score2 == 7) {
        serv = !serv;
      } else if (score2 == 9) {
        serv = !serv;
      }
    }


    if (score == 1) {
      if (mouseX >= scorePX[0] && mouseX <= scorePX[0] + knopBreedtePunten &&
        mouseY >= scoreY && mouseY <= scoreY + knopHoogtePunten && spelIsGestart == true) {
        serv = !serv;
      } else if (mouseX >= scorePX[1] && mouseX <= scorePX[1] + knopBreedtePunten &&
        mouseY >= scoreY && mouseY <= scoreY + knopHoogtePunten && spelIsGestart == true) {
        serv = !serv;
      }
    }
  }
}