package SuperMarioUltraland;

import java.util.List;

import nl.han.ica.OOPDProcessingEngineHAN.Collision.ICollidableWithGameObjects;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.GameObject;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.Sprite;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.SpriteObject;

public class Fireball extends SpriteObject implements ICollidableWithGameObjects {
	
	private boolean hitMario = false;
	private int fallSpeed = 3;
	
	public Fireball() {
		super(new Sprite("src/main/java/SuperMarioUltraland/sprites/fireball.png"));

	}

	@Override
	public void update() {
		y+= fallSpeed;

	}

	/**
	 * Deze functie kijkt of de fireball collision heeft met Mario. Als dit het geval is, dan gaat er 1 leven van Mario's health af.
	 */
	@Override
	public void gameObjectCollisionOccurred(List<GameObject> collidedGameObjects) {
		for (GameObject g : collidedGameObjects) {
			if (g instanceof Mario) {
				Mario m = (Mario) g;
				setHitMario(true);
				m.setHealth(-1);
				m.setMarioToDamageSprite();

			}
		}
	}

	public boolean isHitMario() {
		return hitMario;
	}

	public void setHitMario(boolean hitMario) {
		this.hitMario = hitMario;
	}

}
