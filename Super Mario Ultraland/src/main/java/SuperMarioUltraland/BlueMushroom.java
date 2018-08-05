package SuperMarioUltraland;

import java.util.List;

import nl.han.ica.OOPDProcessingEngineHAN.Collision.ICollidableWithGameObjects;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.GameObject;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.Sprite;

public class BlueMushroom extends PowerUp {
	
	
	
	public BlueMushroom() {
		super(new Sprite("src/main/java/SuperMarioUltraland/sprites/bluemushroom.png"));
		// TODO Auto-generated constructor stub
	}

	@Override
	public void update() {
		// TODO Auto-generated method stub
		
	}
	
	/**
	 * Deze functie kijkt of Mario collision heeft met de blueMushroom. Als dit het geval is, wordt de loopsnelheid van mario op 10 gezet
	 * en de boolean pickedUp op true.
	 */
	@Override
	public void gameObjectCollisionOccurred(List<GameObject> collidedGameObjects) {
		for(GameObject g : collidedGameObjects) {
			if(g instanceof Mario) {
				Mario m = (Mario) g;
				m.setSpeed(10);
				pickedUp = true;
			}
		}
		
	}
}
