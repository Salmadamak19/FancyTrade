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
                makeUsersButton(),
                makePublicationsButton(),
                makeCommentsButton(),
                makePostsButton(),
                makeCommentairesButton(),
                makeEventButton(),
                makeEventPlaceButton()
        );

        this.add(menuContainer);
    }

    private Button makeUsersButton() {
        Button button = new Button("Users");
        button.setUIID("buttonMenu");
        button.setMaterialIcon(FontImage.MATERIAL_PERSON);
        button.addActionListener(action -> new com.fancytrade.gui.back.user.AfficherToutUser(this).show());
        return button;
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
    private Button makePostsButton() {
        Button button = new Button("Posts");
        button.setUIID("buttonMenu");
        button.setMaterialIcon(FontImage.MATERIAL_POST_ADD);
        button.addActionListener(action -> new com.fancytrade.gui.back.post.AfficherToutPost(this).show());
        return button;
    }
    private Button makeCommentairesButton() {
        Button button = new Button("Commentaires");
        button.setUIID("buttonMenu");
        button.setMaterialIcon(FontImage.MATERIAL_MESSAGE);
        button.addActionListener(action -> new com.fancytrade.gui.back.commentaire.AfficherToutCommentaire(this).show());
        return button;
    }
        private Button makeEventPlaceButton() {
        Button button = new Button("Event Place");
        button.setUIID("buttonMenu");
        button.setMaterialIcon(FontImage.MATERIAL_MESSAGE);
        button.addActionListener(action -> new com.fancytrade.gui.back.eventplace.AfficherToutEventPlace(this).show());
        return button;
    }
                private Button makeEventButton() {
        Button button = new Button("Event ");
        button.setUIID("buttonMenu");
        button.setMaterialIcon(FontImage.MATERIAL_MESSAGE);
       // button.addActionListener(action -> new com.fancytrade.gui.back.event.AfficherToutEvent(this).show());
        return button;
    }

}
