package com.fancytrade.gui.front.reclamation;

import com.codename1.ui.*;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;

public class AccueilFront extends Form {

    Resources theme = UIManager.initFirstTheme("/theme");
    Label label;

    public AccueilFront() {
        super("Menu", new BoxLayout(BoxLayout.Y_AXIS));
        addGUIs();
    }

    private void addGUIs() {
        label = new Label("Front");
        label.setUIID("links");

        Container userContainer = new Container(new BorderLayout());
        userContainer.setUIID("userContainer");
        userContainer.add(BorderLayout.CENTER, label);

        Container menuContainer = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        menuContainer.addAll(
                userContainer,
                makeAnimalsButton() 
                
                
        );

        this.add(menuContainer);
    }
    
    private Button makeAnimalsButton() {
        Button button = new Button("reclamations");
        button.setUIID("buttonMenu");
        //button.setMaterialIcon(FontImage.MATERIAL_BOOKMARK);
        button.addActionListener(action -> new com.fancytrade.gui.front.reclamation.Animals.ShowAll(this).show());
        return button;
    }
    
    
}