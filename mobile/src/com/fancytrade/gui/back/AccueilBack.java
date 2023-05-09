package com.fancytrade.gui.back;

import com.codename1.ui.*;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.fancytrade.gui.uikit.LoginForm;

public class AccueilBack extends Form {

    Resources theme = UIManager.initFirstTheme("/theme");
    Label label;
    Form previous;
    public static Form accueilForm;

    public AccueilBack(Form previous) {
        super("Menu", new BoxLayout(BoxLayout.Y_AXIS));
        this.previous = previous;
        accueilForm = this;
        addGUIs();
    }

    private void addGUIs() {
        label = new Label("Espace administrateur"/*MainApp.getSession().getEmail()*/);
        label.setUIID("links");
        Button btnDeconnexion = new Button();
        btnDeconnexion.setMaterialIcon(FontImage.MATERIAL_ARROW_FORWARD);
        btnDeconnexion.addActionListener(action -> {
            LoginForm.loginForm.showBack();
        });

        Container userContainer = new Container(new BorderLayout());
        userContainer.setUIID("userContainer");
        userContainer.add(BorderLayout.CENTER, label);
        userContainer.add(BorderLayout.EAST, btnDeconnexion);

        Container menuContainer = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        menuContainer.addAll(
                userContainer,
                makePublicationsButton(),
                makeCommentsButton()
        );

        this.add(menuContainer);
    }

    private Button makePublicationsButton() {
        Button button = new Button("Publications");
        button.setUIID("buttonMenu");
        button.setMaterialIcon(FontImage.MATERIAL_BOOK);
        button.addActionListener(action -> new com.fancytrade.gui.back.publication.AfficherToutPublication(this).show());
        return button;
    }
    private Button makeCommentsButton() {
        Button button = new Button("Comments");
        button.setUIID("buttonMenu");
        button.setMaterialIcon(FontImage.MATERIAL_COMMENT);
        button.addActionListener(action -> new com.fancytrade.gui.back.comment.AfficherToutComment(this).show());
        return button;
    }

}
