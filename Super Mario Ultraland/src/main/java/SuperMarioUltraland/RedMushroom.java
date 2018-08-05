package SuperMarioUltraland;

import java.util.List;

import nl.han.ica.OOPDProcessingEngineHAN.Collision.ICollidableWithGameObjects;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.GameObject;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.Sprite;

public class RedMushroom extends PowerUp{
	
	public RedMushroom() {
		super(new Sprite("src/main/java/SuperMarioUltraland/sprites/redmushroom.png"));
		// TODO Auto-generated constructor stub
	}

	@Override
	public void update() {
		// TODO Auto-generated method stub
		
	}
	
	/**
	 * Deze functie kijkt of Mario collision heeft met de redMushroom. Als dit het geval is, krijgt Mario er 1 leven bij.
	 */
	@Override
	public void gameObjectCollisionOccurred(List<GameObject> collidedGameObjects) {
		for(GameObject g : collidedGameObjects) {
			if(g instanceof Mario) {
				Mario m = (Mario) g;
				m.setHealth(1);
				pickedUp = true;
			}
		}
		
	}
}
