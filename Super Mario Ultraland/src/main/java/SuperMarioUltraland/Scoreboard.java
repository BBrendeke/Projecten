package SuperMarioUltraland;

import nl.han.ica.OOPDProcessingEngineHAN.Dashboard.Dashboard;

public class Scoreboard extends Dashboard {

	private TextObject scoreText;
	private Ultraland ultraland;

	Scoreboard(int x, int y, int width, int height, Ultraland ultraland) {
		super(x, y, width, height);
		this.ultraland = ultraland;

	}
	
	/**
	 * Deze functie maakt een nieuwe dashboard aan en voegt de text hieraan toe.
	 */
	public void createDashboard() {
		scoreText = new TextObject(" ", 0, 0);
		this.addGameObject(scoreText);

	}

	/**
	 * Deze functie werkt de score bij.
	 */
	public void updateScores() {
		scoreText.setText("Score: " + ultraland.getScore());
	}
}
