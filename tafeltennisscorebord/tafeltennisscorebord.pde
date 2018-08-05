int knopX;
int knopY;
int knopBreedteKeuze;
int knopHoogteKeuze;
int knopBreedtePunten;
int knopHoogtePunten;
int[] textLocatieVerX;
int textGroote;
float textLocY;
float[] scorePX;
float[] scoreNX;
int scoreY;
int[] puntenX;
int puntenY;
int[] setMenuX;
int setMenuY;
float[] bordjesX;
float bordjesY;
float bordjesBreedte;
int textLocatieSet;
float[] setScoreX;
float[] setScoreY;
float setScoreBreedte;
float setScoreHoogte;

int[] ss1;
int[] ss2;


int score1 = 0;
int score2 = 0;

int puntenX1;
int puntenX2;

float wissel1 = width/5;
float wissel2 = width/5 * 4;

int set1 = 0;
int set2 = 0;
int sets = 0;

int winTextX = width/2;
int winTextY = height/2;
int textWinSize = height/4;

boolean start = true;
boolean spelIsGestart = false;
boolean setMenu = false;
boolean serv = true;
boolean verOud = false;
boolean verNieuw = false;
boolean best3 = false;
boolean best5 = false;
boolean best7 = false;
boolean wissel = false;

boolean win1 = false;
boolean win2 = false;



void setup() {
  size(700, 500);

  knopX = width / 10;
  knopY = height / 10; 
  scoreY = height / 10 * 8;

  knopBreedteKeuze = width / 5;
  knopHoogteKeuze = knopBreedteKeuze;

  knopBreedtePunten = width / 7;
  knopHoogtePunten = knopBreedtePunten / 2;

  textLocatieVerX = new int[2];
  textLocatieVerX[0] = knopX;
  textLocatieVerX[1] = knopX/2*14;

  textLocY = knopY + knopHoogteKeuze/2;

  textGroote = knopHoogtePunten/2;

  scorePX = new float[2];
  scorePX[0] = width/4 +20;
  scorePX[1] = (width/4)*3 + 20;

  scoreNX = new float[2];
  scoreNX[0] = width/4-120;
  scoreNX[1] = width/4*3-120;

  setMenuX = new int[3];
  setMenuX[0] = width/10;
  setMenuX[1] = width/2-width/10;
  setMenuX[2] = width/10 * 7;

  setMenuY = height/2;

  textLocatieSet = setMenuY + knopHoogteKeuze/2;

  puntenX = new int[2];
  puntenX[0] = width / 4;
  puntenX[1] = width / 4 * 3;

  puntenY = height/2;

  bordjesX = new float[3];
  bordjesX[0] = width / 5;
  bordjesX[1] = width / 2;
  bordjesX[2] = width / 5 * 4;

  bordjesY = knopHoogtePunten; //de blokjes moeten boven in komen, om te voorkomen dat de helft buiten het scherm valt heb ik de hoogte hier gebruikt als variabele.

  bordjesBreedte = knopBreedtePunten * 1.5;

  setScoreBreedte = bordjesBreedte / 4;
  setScoreHoogte = setScoreBreedte;

  setScoreX = new float[2];
  setScoreX[0] = setScoreBreedte / 2;
  setScoreX[1] = width - setScoreBreedte/2;

  setScoreY = new float[7];
  setScoreY[0] = setScoreHoogte;
  setScoreY[1] = height / 10 + setScoreHoogte;
  setScoreY[2] = height / 10 * 2 + setScoreHoogte;
  setScoreY[3] = height / 10 * 3 + setScoreHoogte;
  setScoreY[4] = height / 10 * 4 + setScoreHoogte;
  setScoreY[5] = height / 10 * 5 + setScoreHoogte;
  setScoreY[6] = height / 10 * 6 + setScoreHoogte;

  ss1 = new int[7];
  ss1[0] = 0;
  ss1[1] = 0;
  ss1[2] = 0;
  ss1[3] = 0;
  ss1[4] = 0;
  ss1[5] = 0;
  ss1[6] = 0;

  ss2 = new int[7];
  ss2[0] = 0;
  ss2[1] = 0;
  ss2[2] = 0;
  ss2[3] = 0;
  ss2[4] = 0;
  ss2[5] = 0;
  ss2[6] = 0;



  wissel1 = width/5; //ik heb de waardes uit de array over genomen omdat uit array zorgde voor problemen.
  wissel2 = width/5 * 4;

  puntenX1 = puntenX[0]*3;
  puntenX2 = puntenX[1]/3;

  winTextX = width/2;
  winTextY = height/2;
  textWinSize = height/10;
}

void draw() {

  background(0);

  if (setMenu) {
    keuzeSets();
    fill(255);
    textAlign(CORNER, TOP);
    textSize(textGroote);
    text("Best Of 3", setMenuX[0], textLocatieSet);
    text("Best Of 5", setMenuX[1], textLocatieSet);
    text("Best Of 7", setMenuX[2], textLocatieSet);
  } else if (spelIsGestart) {
    stroke(255);
    line(width/2, 0, width/2, height);
    noStroke();
    puntenKnoppen();
    puntenTeller();
    bordjes();
    setScoreBordjes();
    servWissel();
    kantWissel();
    sets();
    spelers();
    setScore();
    winScherm();
  }if (win1) { 
    fill(0,255,0);
    textAlign(CENTER);
    textSize(textWinSize);
    text("Speler1 heeft gewonnen!", winTextX, winTextY);
    setScore();
  } else if (win2) {
    fill(0,255,0);
    textAlign(CENTER);
    textSize(textWinSize);
    text("Speler2 heeft gewonnen!", winTextX, winTextY);
    setScore();
  } else if (start) {
    tekenKnop();
    fill(255);
    textSize(textGroote);
    text("Nieuw", textLocatieVerX[0], textLocY);
    text("Oud", textLocatieVerX[1], textLocY);
  }
}