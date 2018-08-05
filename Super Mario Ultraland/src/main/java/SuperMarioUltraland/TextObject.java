package SuperMarioUltraland;

import nl.han.ica.OOPDProcessingEngineHAN.Objects.GameObject;
import processing.core.PGraphics;

public class TextObject extends GameObject {

    private String text;
    private int x, y;

    public TextObject(String text, int x, int y) {
        this.text=text;
        this.x = x;
        this.y = y;
    }

    public void setText(String text) {
        this.text=text;
    }

    @Override
    public void update() {

    }

    @Override
    public void draw(PGraphics g) {
        g.textAlign(g.LEFT,g.TOP);
        g.textSize(25);
        g.text(text, x, y);
    }
}

