package SuperMarioUltraland;

import java.util.List;

import nl.han.ica.OOPDProcessingEngineHAN.Collision.ICollidableWithGameObjects;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.GameObject;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.Sprite;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.SpriteObject;

public abstract class PowerUp extends SpriteObject implements ICollidableWithGameObjects {
	
	protected boolean pickedUp = false;
	public PowerUp(Sprite sprite) {
		super(sprite);
		// TODO Auto-generated constructor stub
	}
	
	public boolean getPickedUp() {
		return pickedUp;
	}
	
	public abstract void gameObjectCollisionOccurred(List<GameObject> collidedGameObjects);
}
