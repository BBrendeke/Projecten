package SuperMarioUltraland;

import java.util.List;

import nl.han.ica.OOPDProcessingEngineHAN.Collision.CollidedTile;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.Sprite;

public class Schroomba extends Enemy {

	private static Sprite sprite = new Sprite("src/main/java/SuperMarioUltraland/sprites/schroomba_walking.png");
	private boolean isAlive = true;

	public Schroomba() {
		super(sprite, 2);

	}
	
	/**
	 * Deze functie laat een schroomba heen en weer lopen.
	 */
	@Override
	public void update() {

		if (!walkDirection) {

			x+= speed;
			nextFrame();
		} else {

			x-= speed;
			nextFrame();
		}

	}
	
	/**
	 * Deze functie zorgt ervoor dat de sprite van de schroomba verandert als de schroomba van looprichting verandert.
	 */
	public void switchWalkingSprite() {

		if (walkDirection == true) {
			sprite.setSprite("src/main/java/SuperMarioUltraland/sprites/schroomba_walking.png");
		}

		else {

			sprite.setSprite("src/main/java/SuperMarioUltraland/sprites/schroomba_walking_mirror.png");
		}

	}

	public boolean getIsAlive() {
		return isAlive;
	}

	public void setAlive(boolean isAlive) {
		this.isAlive = isAlive;
	}
	
	/**
	 * Deze functie kijkt of een schroomba collision heeft met een tile. Als dit het geval is, dan verandert de looprichting en sprite
	 * van de schroomba.
	 */
	@Override
	public void tileCollisionOccurred(List<CollidedTile> collidedTiles) {
		for (int i = 0; i < collidedTiles.size(); i++) {

			if (collidedTiles.get(i).collisionSide == collidedTiles.get(i).LEFT) {
				setX(x - 5);
				walkDirection = true;
				switchWalkingSprite();
			}

			if (collidedTiles.get(i).collisionSide == collidedTiles.get(i).RIGHT) {
				setX(x + 5);
				walkDirection = false;
				switchWalkingSprite();
			}

			if (collidedTiles.get(i).collisionSide == collidedTiles.get(i).TOP) {
				setY(y - 1);
			}

		}

	}

}
