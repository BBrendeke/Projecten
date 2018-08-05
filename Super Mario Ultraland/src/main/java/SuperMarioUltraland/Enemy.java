package SuperMarioUltraland;

import java.util.List;

import nl.han.ica.OOPDProcessingEngineHAN.Collision.CollidedTile;
import nl.han.ica.OOPDProcessingEngineHAN.Collision.ICollidableWithTiles;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.AnimatedSpriteObject;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.Sprite;

public abstract class Enemy extends AnimatedSpriteObject implements ICollidableWithTiles {

	protected int speed = 1;
	protected boolean walkDirection = true;

	public Enemy(Sprite sprite, int totalFrames) {
		super(sprite, totalFrames);

	}

	@Override
	public void update() {
	}

	@Override
	public void tileCollisionOccurred(List<CollidedTile> collidedTiles) {

	}
}
