package com.fancytrade.gui.back.reclamation;

import com.codename1.ui.*;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;

public class AccueilBack extends Form {

    Resources theme = UIManager.initFirstTheme("/theme");
    Label label;

    public AccueilBack() {
        super("Menu", new BoxLayout(BoxLayout.Y_AXIS));
        addGUIs();
    }

    private void addGUIs() {
        label = new Label("Admin"/*MainApp.getSession().getEmail()*/);
        label.setUIID("links");

        Container userContainer = new Container(new BorderLayout());
        userContainer.setUIID("userContainer");
        userContainer.add(BorderLayout.CENTER, label);

        Container menuContainer = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        menuContainer.addAll(
                userContainer,
                makeAnimalsButton(), 
                makeAnimalsCategoryButton()
                
        );

        this.add(menuContainer);
    }

    private Button makeAnimalsButton() {
        Button button = new Button("Reclamations");
        button.setUIID("buttonMenu");
        //button.setMaterialIcon(FontImage.MATERIAL_BOOKMARK);
        button.addActionListener(action -> new com.fancytrade.gui.back.reclamation.Animals.ShowAll(this).show());
        return button;
    }
    private Button makeAnimalsCategoryButton() {
        Button button = new Button("ReclamationsCategory");
        button.setUIID("buttonMenu");
        //button.setMaterialIcon(FontImage.MATERIAL_BOOKMARK);
        button.addActionListener(action -> new com.fancytrade.gui.back.reclamation.AnimalsCategory.ShowAll(this).show());
        return button;
    }
    
}
