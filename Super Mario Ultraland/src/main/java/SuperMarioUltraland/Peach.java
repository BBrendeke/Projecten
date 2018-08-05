package SuperMarioUltraland;

import java.util.List;
import nl.han.ica.OOPDProcessingEngineHAN.Collision.ICollidableWithGameObjects;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.GameObject;
import nl.han.ica.OOPDProcessingEngineHAN.Objects.Sprite;

public class Peach extends Enemy implements ICollidableWithGameObjects {

	private static Sprite sprite = new Sprite("src/main/java/SuperMarioUltraland/sprites/peach.png");
	private Health health = new Health(3);
	private int direction = -1;
	private Ultraland ultraland;
	private int startX = 3000;

	public Peach(Ultraland ultraland) {
		super(sprite, 1);
		this.ultraland = ultraland;

	}

	/**
	 * Deze functie laat Peach heen en weer lopen binnen het kasteel en laat Peach aanvallen als ze 300 pixels heeft afgelegd.
	 */
	@Override
	public void update() {

		if (startX - x == 300 || x - startX == 300) {
			startX = (int) x;
			attack();
		}

		switch (direction) {
		case -1:

			if (x > 2600) {
				x -= (speed);
			} else {

				direction = 1;
			}
			break;

		case 1:

			if (x < 3800) {
				x += (speed);
			} else {

				direction = -1;
			}
			break;
		}

	}
	
	/**
	 * Deze functie voegt Fireballs toe aan de gameEngine, wat de aanval van Peach is.
	 */
	public void attack() {
		for (int i = 0; i < 5; i++) {
			ultraland.addGameObject(new Fireball(), x + (i * 100), 0);
		}
	}

	/**
	 * Deze functie kijkt of Peach collision heeft met Mario. Als dit het geval is, dan verliest Mario al zijn health.
	 */
	@Override
	public void gameObjectCollisionOccurred(List<GameObject> collidedGameObjects) {
		for (GameObject g : collidedGameObjects) {
			if (g instanceof Mario) {
				Mario m = (Mario) g;
				m.setHealth(-99);
			}
		}
	}

	public int getHealth() {
		return health.getAmount();
	}

	public void setHealth(int amount) {

		health.setAmount(amount);
	}

	public int getStartX() {
		return startX;
	}
}
