

void tekenKnop() {
  int[] locatieX = {1, 7};

  fill(0, 255, 0);  
  for (int i = 0; i < locatieX.length; i++) {
    rectMode(CORNER);
    rect(locatieX[i] * knopX, knopY, knopBreedteKeuze, knopHoogteKeuze);
  }
}

void keuzeSets() {
  fill(0, 0, 255);  
  for (int i = 0; i < setMenuX.length; i++) {
    rectMode(CORNER);
    rect(setMenuX[i], setMenuY, knopBreedteKeuze, knopHoogteKeuze);
  }
}


void puntenKnoppen() {
  fill(0, 255, 0); 
  for (int i = 0; i < scorePX.length; i++) {
    rectMode(CORNER);  
    rect(scorePX[i], scoreY, knopBreedtePunten, knopHoogtePunten);
    fill(255);
    textAlign(CENTER, CENTER);
    text("+", scorePX[i]+(knopBreedtePunten/2), scoreY + (knopHoogtePunten/2));
    fill(0, 255, 0);
  }
  fill(255, 0, 0);
  for (int i = 0; i < scoreNX.length; i++) {
    rectMode(CORNER);  
    rect(scoreNX[i], scoreY, knopBreedtePunten, knopHoogtePunten);
    fill(255);
    textAlign(CENTER, CENTER);
    text("-", scoreNX[i]+(knopBreedtePunten/2), scoreY + (knopHoogtePunten/2));
    fill(255, 0, 0);
  }
}

void mouseClicked() {

  serv();

  if (mouseX >= knopX && mouseX <= knopX + knopBreedteKeuze &&
    mouseY >= knopY && mouseY <= knopY + knopHoogteKeuze && spelIsGestart == false && setMenu == false) {
    setMenu = !setMenu;
    verNieuw =!verNieuw;
    start = !start;
  } else if (mouseX >= 7 * knopX && mouseX <= 7 * knopX + knopBreedteKeuze &&
    mouseY >= knopY && mouseY <= knopY + knopHoogteKeuze && spelIsGestart == false && setMenu == false) {
    setMenu = !setMenu;
    verOud = !verOud;
    start = !start;
  }
  if (mouseX >= setMenuX[0] && mouseX <= setMenuX[0] + knopBreedteKeuze &&
    mouseY >= setMenuY && mouseY <= setMenuY + knopHoogteKeuze && setMenu == true && spelIsGestart == false) {
    spelIsGestart = !spelIsGestart; 
    setMenu = !setMenu;
    best3 = !best3;
  } else if (mouseX >= setMenuX[1] && mouseX <= setMenuX[1] + knopBreedteKeuze &&
    mouseY >= setMenuY && mouseY <= setMenuY + knopHoogteKeuze && setMenu == true && spelIsGestart == false) {
    spelIsGestart = !spelIsGestart; 
    setMenu = !setMenu;
    best5 = !best5;
  } else if (mouseX >= setMenuX[2] && mouseX <= setMenuX[2] + knopBreedteKeuze &&
    mouseY >= setMenuY && mouseY <= setMenuY + knopHoogteKeuze && setMenu == true && spelIsGestart == false) {
    spelIsGestart = !spelIsGestart; 
    setMenu = !setMenu;
    best7 = !best7;
  }



  if (mouseX >= scorePX[0] && mouseX <= scorePX[0] + knopBreedtePunten &&
    mouseY >= scoreY && mouseY <= scoreY + knopHoogtePunten && spelIsGestart == true) {
    if (wissel == false) {
      score1 = score1 +1;
    
    if (sets ==0) {
      ss1[0] = ss1[0] +1;
    } else if (sets ==1) {
      ss1[1] = ss1[1] +1;
    } else if (sets == 2) {
      ss1[2] = ss1[2] +1;
    } else if (sets == 3) {
      ss1[3] = ss1[3] +1;
    } else if (sets == 4) {
      ss1[4] = ss1[4] +1;
    } else if (sets == 5) {
      ss1[5] = ss1[5] +1;
    } else if (sets == 6) {
      ss1[6] = ss1[6] +1;
    }
    } else if (wissel) {
      score2 = score2 +1;
      if (sets == 3) {
      ss1[3] = ss1[3] +1;
    } else if (sets == 4) {
      ss1[4] = ss1[4] +1;
    } else if (sets == 5) {
      ss1[5] = ss1[5] +1;
    } else if (sets == 6) {
      ss1[6] = ss1[6] +1;
    }
    }
  } else if (mouseX >= scoreNX[0] && mouseX <= scoreNX[0] + knopBreedtePunten &&
    mouseY >= scoreY && mouseY <= scoreY + knopHoogtePunten && spelIsGestart == true) {
    if (wissel == false) {
      score1 = score1 -1;
    if (sets ==0) {
      ss1[0] = ss1[0] -1;
    } else if (sets ==1) {
      ss1[1] = ss1[1] -1;
    } else if (sets == 2) {
      ss1[2] = ss1[2] -1;
    } else if (sets == 3) {
      ss1[3] = ss1[3] -1;
    } else if (sets == 4) {
      ss1[4] = ss1[4] -1;
    } else if (sets == 5) {
      ss1[5] = ss1[5] -1;
    } else if (sets == 6) {
      ss1[6] = ss1[6] -1;
    }
    } else if (wissel) {
      score2 = score2 -1;
     if (sets == 3) {
      ss1[3] = ss1[3] -1;
    } else if (sets == 4) {
      ss1[4] = ss1[4] -1;
    } else if (sets == 5) {
      ss1[5] = ss1[5] -1;
    } else if (sets == 6) {
      ss1[6] = ss1[6] -1;
    }
    }
  }
  if (mouseX >= scorePX[1] && mouseX <= scorePX[1] + knopBreedtePunten &&
    mouseY >= scoreY && mouseY <= scoreY + knopHoogtePunten && spelIsGestart == true) {
    if (wissel == false) {
      score2 = score2 +1;
    if (sets ==0) {
      ss2[0] = ss2[0] +1;
    } else if (sets ==1) {
      ss2[1] = ss2[1] +1;
    } else if (sets == 2) {
      ss2[2] = ss2[2] +1;
    } else if (sets == 3) {
      ss2[3] = ss2[3] +1;
    } else if (sets == 4) {
      ss2[4] = ss2[4] +1;
    } else if (sets == 5) {
      ss2[5] = ss2[5] +1;
    } else if (sets == 6) {
      ss2[6] = ss2[6] +1;
    }
    } else if (wissel) {
      score1 = score1 +1;
     if (sets == 3) {
      ss2[3] = ss2[3] +1;
    } else if (sets == 4) {
      ss2[4] = ss2[4] +1;
    } else if (sets == 5) {
      ss2[5] = ss2[5] +1;
    } else if (sets == 6) {
      ss2[6] = ss2[6] +1;
    }}
  } else if (mouseX >= scoreNX[1] && mouseX <= scoreNX[1] + knopBreedtePunten &&
    mouseY >= scoreY && mouseY <= scoreY + knopHoogtePunten && spelIsGestart == true) {
    if (wissel == false) {
      score2 = score2 -1;
     if (sets ==0) {
      ss2[0] = ss2[0] -1;
    } else if (sets ==1) {
      ss2[1] = ss2[1] -1;
    } else if (sets == 2) {
      ss2[2] = ss2[2] -1;
    } else if (sets == 3) {
      ss2[3] = ss2[3] -1;
    } else if (sets == 4) {
      ss2[4] = ss2[4] -1;
    } else if (sets == 5) {
      ss2[5] = ss2[5] -1;
    } else if (sets == 6) {
      ss2[6] = ss2[6] -1;
    }
    }else if (wissel) {
      score1 = score1 -1;
      if (sets == 3) {
      ss2[3] = ss2[3] -1;
    } else if (sets == 4) {
      ss2[4] = ss2[4] -1;
    } else if (sets == 5) {
      ss2[5] = ss2[5] -1;
    } else if (sets == 6) {
      ss2[6] = ss2[6] -1;
    }
    }
  }
}