package SuperMarioUltraland;

import java.util.ArrayList;
import java.util.Iterator;
import java.util.Vector;

import nl.han.ica.OOPDProcessingEngineHAN.Dashboard.Dashboard;
import nl.han.ica.OOPDProcessingEngineHAN.Engine.GameEngine;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.AnimatedSpriteObject;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.GameObject;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.Sprite;
import nl.han.ica.OOPDProcessingEngineHAN.Sound.Sound;
import nl.han.ica.OOPDProcessingEngineHAN.Tile.TileMap;
import nl.han.ica.OOPDProcessingEngineHAN.Tile.TileType;
import nl.han.ica.OOPDProcessingEngineHAN.View.EdgeFollowingViewport;
import nl.han.ica.OOPDProcessingEngineHAN.View.View;
import nl.han.ica.waterworld.tiles.BoardsTile;

@SuppressWarnings("serial")
public class Ultraland extends GameEngine {

	final int worldWidth = 4849;
	final int worldHeight = 860;

	final int screenWidth = 1300;
	final int screenHeight = 660;

	private int score = 0;
	private Scoreboard scoreboard;

	private Mario mario = new Mario(this);
	private Peach peach = new Peach(this);
	private Axe axe = new Axe();
	private ArrayList<PowerUp> powerUps = new ArrayList<PowerUp>();
	public Vector<GameObject> gOList;

	private Sound levelComplete;
	private Sound backgroundMusicOverworld;
	private Sound backgroundMusicCastle;

	public static void main(String[] args) {
		Ultraland ultraland = new Ultraland();
		ultraland.runSketch();
	}

	public void setupGame() {
		spawnGameObjects();
		spawnPowerUps();
		createFollowingViewPort(screenWidth, screenHeight, worldWidth, worldHeight);
		intializeSound();
		initializeTileMap();
		initalizeScoreboard();
		gOList = getGameObjectItems();

	}

	@Override
	public void update() {
		checkIfAnimatedSpriteObjectIsAlive();
		checkIfPowerUpIsPickedUp();
		setAnimatedSpriteObjectBounderies(worldWidth, worldHeight);
		scoreboard.updateScores();

	}

	/**
	 * 
	 * Deze functie maakt een viewport aan die de speler volgt. Als parameters wordt
	 * de hoogte en breedte van de wereld meegegeven en de breedte en hoogte van het
	 * scherm wat de speler ziet.
	 * 
	 * @param screenWidth
	 * @param screenHeight
	 * @param worldWidth
	 * @param worldHeight
	 */
	public void createFollowingViewPort(int screenWidth, int screenHeight, int worldWidth, int worldHeight) {
		EdgeFollowingViewport viewPort = new EdgeFollowingViewport(mario, screenWidth, screenHeight,
				mario.getCenterX() - (screenWidth / 2), mario.getCenterY() - (screenHeight / 2));

		viewPort.setTolerance(0, 0, 0, (screenWidth / 2));
		View view = new View(viewPort, worldWidth, worldHeight);

		setView(view);
		size(screenWidth, screenHeight);
		view.setBackground(loadImage("src/main/java/SuperMarioUltraland/tiles/background.jpg"));
	}

	/**
	 * 
	 * Deze functie initaliseert alle geluiden en speelt de achtergrond muziek af.
	 */
	public void intializeSound() {

		levelComplete = new Sound(this, "src/main/java/SuperMarioUltraland/Sound/level_complete.mp3");

		backgroundMusicOverworld = new Sound(this, "src/main/java/SuperMarioUltraland/Sound/Overworld.mp3");

		backgroundMusicCastle = new Sound(this, "src/main/java/SuperMarioUltraland/Sound/Castle.mp3");

		backgroundMusicOverworld.loop(0);
	}

	/**
	 * Deze functie verandert de muziek van de overworld muziek naar de castle
	 * muziek
	 */
	public void switchToCastleSound() {
		backgroundMusicOverworld.pause();
		backgroundMusicCastle.loop(0);
	}

	/**
	 * Deze functie zorgt ervoor dat gameObjecten niet buiten de wereld kunnen komen
	 * 
	 * 
	 * @param screenWidth
	 * @param screenHeight
	 * @param worldWidth
	 * @param worldHeight
	 */
	private void setAnimatedSpriteObjectBounderies(int worldWidth, int worldHeigth) {

		for (GameObject g : gOList) {

			if (g.getCenterX() > worldWidth - (g.getWidth() / 2 - 5)) {
				g.setX(worldWidth - g.getWidth());

				if (g instanceof Enemy) {
					Enemy e = (Enemy) g;
					switchEnemyDirection(e);
				}
			} else if (g.getCenterX() <= 0 + (g.getWidth() / 2)) {
				g.setX(0 + (g.getWidth() / 2));

				if (g instanceof Enemy) {
					Enemy e = (Enemy) g;
					switchEnemyDirection(e);
				}
			} else if (g.getY() >= worldHeigth - (g.getHeight())) {
				g.setY(worldHeigth - g.getHeight());
			}
		}
	}

	/**
	 * 
	 * Met deze functie kunnen animatedSpriteObjecten worden toegevoegd aan de
	 * gameEngine
	 * 
	 * @param object
	 */
	private void addAnimatedSpriteObject(AnimatedSpriteObject object, float x, float y) {
		addGameObject(object, x, y);
	}

	/**
	 * 
	 * Deze functie verandert de looprichting van de meegegeven enemy
	 * 
	 * @param enemy
	 */
	private void switchEnemyDirection(Enemy enemy) {
		if (enemy.walkDirection) {
			enemy.walkDirection = false;
		} else {
			enemy.walkDirection = true;
		}
		if (enemy instanceof Schroomba) {
			Schroomba schroomba = (Schroomba) enemy;
			schroomba.switchWalkingSprite();
		}
	}

	/**
	 * 
	 * Deze functie initaliseert de tiles en tilemap wat er voor zorgt dat de tiles
	 * in de wereld worden weergeven.
	 */
	private void initializeTileMap() {
		Sprite blockSprite = new Sprite("src/main/java/SuperMarioUltraland/tiles/block.png");
		Sprite breakableBlockSprite = new Sprite("src/main/java/SuperMarioUltraland/tiles/breakableblock.png");
		TileType<Block> blockTileType = new TileType<Block>(Block.class, blockSprite);
		TileType<BreakableBlock> breakableBlockTileType = new TileType<BreakableBlock>(BreakableBlock.class,
				breakableBlockSprite);

		TileType[] tileTypes = { blockTileType, breakableBlockTileType };
		int tileSize = 50;
		int tilesMap[][] = {
				{ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 },
				{ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 },
				{ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 },
				{ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 },
				{ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, 0, 1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, 0, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 },
				{ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 },
				{ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, 0, 0, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 },
				{ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 },
				{ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, 0, 0, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, 0, 0, 0, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 },
				{ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 },
				{ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 },
				{ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, 0, 0, 0, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 },
				{ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, 0, 0, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 },
				{ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, 0, 1, 1, 0, -1, -1, -1, -1, -1, -1, -1, 0, 0,
						0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, 1, 1, 1, 0, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 },
				{ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 },
				{ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 },
				{ -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
						-1, -1, -1, -1, -1, -1, -1, -1, 0, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1 } };
		tileMap = new TileMap(tileSize, tileTypes, tilesMap);
	}

	/**
	 * Deze functie controleert of powerUps door de speler zijn opgepakt. Wanneer
	 * deze zijn opgepakt, dan worden deze verwijdert van de gameEngine.
	 */
	private void checkIfPowerUpIsPickedUp() {
		for (PowerUp p : powerUps) {
			if (p.getPickedUp()) {
				deleteGameObject(p);
			}
		}

	}

	/**
	 * 
	 * Checkt of AnimatedSpriteObjecten wel of niet levend zijn. De objecten worden
	 * verwijdert van de game als blijkt dat deze niet levend zijn.
	 * 
	 */
	private void checkIfAnimatedSpriteObjectIsAlive() {

		for (int j = 0; j < gOList.size(); j++) {
			GameObject obj = gOList.get(j);

			if (obj instanceof Schroomba) {
				Schroomba s = (Schroomba) obj;
				if (s.getIsAlive() == false) {
					deleteGameObject(s);
					incrementScore(5);
				}
			}

			if (obj instanceof Mario) {
				Mario m = (Mario) obj;

				if (m.getHealth() <= 0) {
					deleteGameObject(m);
					System.out.println("Game Over");
				}
			}

			if (obj instanceof Peach) {
				Peach p = (Peach) obj;

				if (p.getHealth() == 0) {
					deleteGameObject(p);
					incrementScore(9001);
					System.out.println("Boss defeated");
					score += 9000;
					levelComplete.loop(0);
					backgroundMusicCastle.pause();
				}
			}

			if (obj instanceof Axe) {
				Axe a = (Axe) obj;

				if (a.getAxeHit() == true) {
					peach.setHealth(3);
				}
			}

			if (obj instanceof Fireball) {
				Fireball fireball = (Fireball) obj;
				if (fireball.getY() >= worldHeight - fireball.getHeight() || fireball.isHitMario() == true) {
					deleteGameObject(fireball);
				}

			}
		}
	}

	/**
	 * Deze functie spawnt alle gameObjecten in de wereld.
	 */
	private void spawnGameObjects() {

		addAnimatedSpriteObject(mario, 500, worldHeight - mario.getHeight());
		addAnimatedSpriteObject(peach, peach.getStartX(), worldHeight - peach.getHeight());
		addGameObject(axe, 3700, worldHeight - axe.getHeight());
		int[] schroombaPositions = { 100, 420, 1000, 1300, 1500, 2000, 2200 };

		for (int i = 0; i < schroombaPositions.length; i++) {
			addAnimatedSpriteObject(new Schroomba(), schroombaPositions[i], worldHeight - 50);
		}
	}

	/**
	 * Deze functie spawnt alle powerups in de wereld.
	 */
	private void spawnPowerUps() {
		powerUps.add(new RedMushroom());
		powerUps.add(new BlueMushroom());
		int[][] mushroomPositions = { { 2000, 150 }, { 1300, 150 } };

		for (int i = 0; i < powerUps.size(); i++) {
			addGameObject(powerUps.get(i), mushroomPositions[i][0], mushroomPositions[i][1]);
		}
	}

	/**
	 * Deze functie initaliseert het scoreboard
	 */
	public void initalizeScoreboard() {
		scoreboard = new Scoreboard(0, 0, worldWidth, 100, this);
		scoreboard.createDashboard();
		addDashboard(scoreboard);
	}

	/**
	 * Deze functie zorgt ervoor dat de score wordt verhoogt met het meegegeven
	 * aantal.
	 * 
	 * @param score
	 */
	public void incrementScore(int score) {
		this.score += score;
	}

	/**
	 * Deze functie returnt de score.
	 * 
	 * @return
	 */
	public int getScore() {
		return score;
	}
}
