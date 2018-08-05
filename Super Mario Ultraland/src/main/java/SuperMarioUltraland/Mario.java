package SuperMarioUltraland;

import java.util.List;

import nl.han.ica.OOPDProcessingEngineHAN.Collision.CollidedTile;
import nl.han.ica.OOPDProcessingEngineHAN.Collision.ICollidableWithGameObjects;
import nl.han.ica.OOPDProcessingEngineHAN.Collision.ICollidableWithTiles;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.AnimatedSpriteObject;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.GameObject;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.Sprite;
import nl.han.ica.OOPDProcessingEngineHAN.Sound.Sound;
import processing.core.PVector;

public class Mario extends AnimatedSpriteObject implements ICollidableWithGameObjects, ICollidableWithTiles {

	private int speed = 3;
	private static Sprite sprite = new Sprite("src/main/java/SuperMarioUltraland/sprites/mario_walking.png");
	private boolean normalControls = true;
	private Ultraland ultraland;
	private Sound yahoo;
	private Health health = new Health(5);

	/**
	 * De constructor van Mario. Hiermee wordt de sprite meegegeven aan
	 * AnimatedSpriteObject. Ook wordt er friction en gravity ingesteld zodat de
	 * Mario niet blijft doorlopen/springen als de speler op een knop klikt.
	 */
	public Mario(Ultraland ultraland) {

		super(sprite, 4);
		this.ultraland = ultraland;
		setFriction(0.08f);
		setGravity(0.08f);

	}

	@Override
	public void update() {
		if (x >= 2500 && x <= 2510) {
			ultraland.switchToCastleSound();
		}
	}

	/**
	 * Deze functie zorgt ervoor dat de speler Mario kan besturen.
	 * 
	 * @param keyCode
	 * @param key
	 */
	@Override
	public void keyPressed(int keyCode, char key) {

		if (normalControls) {
			switch (keyCode) {

			case 'A':
				setMarioToWalkingSpriteMirror();
				setDirectionSpeed(270, speed);
				nextFrame();
				break;

			case 'D':
				setMarioToWalkingSprite();
				setDirectionSpeed(90, speed);
				nextFrame();
				break;

			case 'W':
				setMarioToJumpingSprite();
				setDirectionSpeed(360, speed);
				setGravity(0.02f);
				break;

			case 'S':
				setMarioToCrouchSprite();
				setGravity(0.2f);
				break;
			}
		}

		if (!normalControls) {
			switch (keyCode) {

			case 'D':
				setMarioToWalkingSpriteMirror();
				setDirectionSpeed(270, speed);
				nextFrame();
				break;

			case 'A':
				setMarioToWalkingSprite();
				setDirectionSpeed(90, speed);
				nextFrame();
				break;

			case 'S':
				setMarioToJumpingSprite();
				setDirectionSpeed(360, speed);
				setGravity(0.08f);
				break;

			case 'W':
				setMarioToCrouchSprite();
				setGravity(0.2f);
				break;
			}

		}

	}

	/**
	 * Onderstaande functies zorgen ervoor dat de Sprites (en de frames hiervan) van
	 * Mario veranderen.
	 */
	private void setMarioToWalkingSprite() {
		sprite.setSprite("src/main/java/SuperMarioUltraland/sprites/mario_walking.png");
		setTotalFrames(4);
	}

	private void setMarioToWalkingSpriteMirror() {
		sprite.setSprite("src/main/java/SuperMarioUltraland/sprites/mario_walking_sprites_mirror.png");
		setTotalFrames(4);
	}

	private void setMarioToJumpingSprite() {
		sprite.setSprite("src/main/java/SuperMarioUltraland/sprites/mario_jumping.png");
		setTotalFrames(0);
		setCurrentFrameIndex(0);
	}

	private void setMarioToCrouchSprite() {
		sprite.setSprite("src/main/java/SuperMarioUltraland/sprites/mario_crouch.png");
		setTotalFrames(0);
		setCurrentFrameIndex(0);
	}

	public void setMarioToDamageSprite() {
		sprite.setSprite("src/main/java/SuperMarioUltraland/sprites/mario_damage.png");
		setTotalFrames(3);
		setCurrentFrameIndex(1);
	}

	/**
	 * Deze functie zorgt ervoor dat Mario collison kan hebben met enemies Op basis
	 * hiervan kan Mario levens verliezen of de Enemy dood gaan. Ook kan op basis
	 * hiervan de boolean voor de controls worden omgewisseld
	 */
	@Override
	public void gameObjectCollisionOccurred(List<GameObject> collidedGameObjects) {

		for (GameObject g : collidedGameObjects) {

			float MarioX = (float) Math.ceil(x + (width / 2));
			float EnemyX = (float) Math.ceil(g.getX() - (g.getWidth() / 2));

			float MarioX2 = (float) Math.ceil(x - (width / 2));
			float EnemyX2 = (float) Math.ceil(g.getX() + (g.getWidth() / 2));

			float MarioY = (float) Math.ceil(y + (height / 2)) + g.getHeight();
			float EnemyY = (float) Math.ceil(g.getY() - (g.getHeight() / 2));

			/**
			 * Zorgt ervoor dat Mario levens verliest als hij door een vijand van de zijkant
			 * wordt geraakt en dat Mario niet door een vijand kan heenlopen.
			 */
			if (g instanceof Schroomba) {
				if (approximatelyEqual(MarioX, EnemyX, 5) == true && approximatelyEqual(MarioY, EnemyY, 5) == false) {

					x = x - (g.getWidth() / 2);
					health.setAmount(1);
					setMarioToDamageSprite();
					System.out.println(getHealth());

				}
				if (approximatelyEqual(MarioX2, EnemyX2, 5) == true && approximatelyEqual(MarioY, EnemyY, 5) == false) {

					x = x + (g.getWidth() / 2);
					health.setAmount(1);
					setMarioToDamageSprite();
					System.out.println(getHealth());

				}

				/**
				 * Zorgt ervoor dat een vijand wordt gedood als Mario op deze springt plus dat
				 * de controls worden omgedraaid door de boolean normalControls
				 */

				if (approximatelyEqual(MarioY, EnemyY, 5) == true) {
					yahoo = new Sound(ultraland, "src/main/java/SuperMarioUltraland/Sound/mario_yahoo.mp3");
					yahoo.loop(0);
					switchControls();
					if (g instanceof Schroomba) {
						Schroomba schroomba = (Schroomba) g;
						schroomba.setAlive(false);
					}
				}
			}
		}

	}

	/**
	 * Deze functie zorgt ervoor dat de controls van Mario omgedraaid worden. Deze
	 * functie wordt aangeroepen als Mario collision heeft met een vijand op de
	 * x-as.
	 */
	public void switchControls() {
		if (normalControls) {
			normalControls = false;
		} else {
			normalControls = true;
		}
	}

	/**
	 * Functie die kijkt of de 2 meegegeven waarde aan elkaar gelijk zijn met een
	 * maximale afwijking van het meegegeven percentage Wordt gebruikt om te kijken
	 * of Mario's positie gelijk is aan de positie van een vijand met een afwijking
	 * van 5% zodat Mario niet door een vijand kan heenlopen aangezien de GameEngine
	 * de positie's niet snel genoeg registreert is een == statement niet voldoende,
	 * vandaar deze functie om te voorkomen dat Mario door vijanden heen kan rennen.
	 * 
	 * @param desiredValue
	 * @param actualValue
	 * @param tolerancePercentage
	 * @return
	 */
	public boolean approximatelyEqual(float desiredValue, float actualValue, float tolerancePercentage) {
		float diff = Math.abs(desiredValue - actualValue);
		float tolerance = tolerancePercentage / 100 * desiredValue;
		return diff < tolerance;
	}

	/**
	 * Deze functie zorgt ervoor dat Mario tegen blokken aanloopt en hier dus
	 * overheen moet springen Ook zorgt deze functie ervoor dat BreakAbleBlocks van
	 * de wereld verdwijnen als Mario hier tegenaan springt.
	 */
	public void tileCollisionOccurred(List<CollidedTile> collidedTiles) {
		for (int i = 0; i < collidedTiles.size(); i++) {

			if (collidedTiles.get(i).collisionSide == collidedTiles.get(i).LEFT) {
				setX(x - 5);
			}

			if (collidedTiles.get(i).collisionSide == collidedTiles.get(i).RIGHT) {
				setX(x + 5);
			}

			if (collidedTiles.get(i).collisionSide == collidedTiles.get(i).TOP) {
				setY(y - 1);
			}

			if (collidedTiles.get(i).collisionSide == collidedTiles.get(i).BOTTOM) {

				if (collidedTiles.get(i).theTile instanceof BreakableBlock) {
					PVector vector = ultraland.getTileMap().getTilePixelLocation(collidedTiles.get(i).theTile);
					ultraland.getTileMap().setTile((int) vector.x / 50, (int) vector.y / 50, -1);
					ultraland.incrementScore(1);

				} else {
					setY(y + 5);
				}

			}

		}

	}

	/**
	 * Deze functie geeft de hoeveelheid health terug zodat de classe Ultraland kan
	 * kijken hoeveel health Mario nog heeft.
	 * 
	 * @return
	 */
	public int getHealth() {

		return health.getAmount();
	}

	public float getSpeed() {
		return speed;
	}

	public void setSpeed(int speed) {
		this.speed = speed;
	}

	public void setHealth(int amount) {
		health.setAmount(-amount);
	}
}
