package SuperMarioUltraland;

import java.util.List;

import nl.han.ica.OOPDProcessingEngineHAN.Collision.ICollidableWithGameObjects;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.GameObject;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.Sprite;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.SpriteObject;

public class Axe extends SpriteObject implements ICollidableWithGameObjects {

	private boolean axeHit = false;

	public Axe() {
		super(new Sprite("src/main/java/SuperMarioUltraland/sprites/axe.png"));
	}

	@Override
	public void update() {
		// TODO Auto-generated method stub

	}
	
	/**
	 * Deze functie kijkt of Mario collision heeft met de axe.
	 */
	@Override
	public void gameObjectCollisionOccurred(List<GameObject> collidedGameObjects) {
		for (GameObject g : collidedGameObjects) {
			if (g instanceof Mario) {
				axeHit = true;

			}
		}

	}
	
	public boolean getAxeHit() {
		return axeHit;
	}
}
