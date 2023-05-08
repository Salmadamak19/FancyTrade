package com.fancytrade.gui.front.commentaire;


import com.codename1.capture.Capture;
import com.codename1.components.ImageViewer;
import com.codename1.ui.*;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.fancytrade.MainApp;
import com.fancytrade.entities.Commentaire;
import com.fancytrade.entities.Post;
import com.fancytrade.gui.front.post.AfficherToutPost;
import com.fancytrade.services.CommentaireService;
import com.fancytrade.services.PostService;

import java.io.IOException;
import java.util.ArrayList;

public class AjouterCommentaire extends Form {


    Resources theme = UIManager.initFirstTheme("/theme");
    String selectedImage;
    boolean imageEdited = false;


    TextField imageTF;
    TextField descriptionTF;
    TextField analyseTF;
    Label imageLabel;
    Label descriptionLabel;
    Label analyseLabel;
    PickerComponent dateTF;
    PickerComponent datecTsTF;

    ArrayList<Post> listPosts;
    PickerComponent postPC;
    Post selectedPost = null;


    ImageViewer imageIV;
    Button selectImageButton;

    Button manageButton;

    Form previous;

    public AjouterCommentaire(Form previous, Post post) {
        super("Ajouter", new BoxLayout(BoxLayout.Y_AXIS));
        this.previous = previous;
        this.selectedPost = post;

        addGUIs();
        addActions();


        getToolbar().addMaterialCommandToLeftBar("  ", FontImage.MATERIAL_ARROW_BACK, e -> previous.showBack());
    }

    private void addGUIs() {

        String[] postStrings;
        int postIndex;
        postPC = PickerComponent.createStrings("").label("Post");
        listPosts = PostService.getInstance().getAll();
        postStrings = new String[listPosts.size()];
        postIndex = 0;
        for (Post post : listPosts) {
            postStrings[postIndex] = post.getSujet();
            postIndex++;
        }
        if (listPosts.size() > 0) {
            postPC.getPicker().setStrings(postStrings);
            postPC.getPicker().addActionListener(l -> selectedPost = listPosts.get(postPC.getPicker().getSelectedStringIndex()));
        } else {
            postPC.getPicker().setStrings("");
        }

        if (selectedPost != null) postPC.getPicker().setSelectedString(selectedPost.getSujet());

        descriptionLabel = new Label("Description : ");
        descriptionLabel.setUIID("labelDefault");
        descriptionTF = new TextField();
        descriptionTF.setHint("Tapez le description");

        dateTF = PickerComponent.createDate(null).label("Date");


        analyseLabel = new Label("Analyse : ");
        analyseLabel.setUIID("labelDefault");
        analyseTF = new TextField();
        analyseTF.setHint("Tapez le analyse");


        datecTsTF = PickerComponent.createDate(null).label("DatecTs");


        imageLabel = new Label("Image : ");
        imageLabel.setUIID("labelDefault");
        selectImageButton = new Button("Ajouter une image");


        imageIV = new ImageViewer(theme.getImage("user-picture.jpg").fill(1100, 500));


        manageButton = new Button("Ajouter");


        Container container = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        container.setUIID("containerRounded");

        container.addAll(
                imageLabel, imageIV,
                selectImageButton,


                descriptionLabel, descriptionTF,
                dateTF,
                analyseLabel, analyseTF,
                datecTsTF,
                postPC,
                manageButton
        );

        this.addAll(container);
    }

    private void addActions() {

        selectImageButton.addActionListener(a -> {
            selectedImage = Capture.capturePhoto(900, -1);
            try {
                imageEdited = true;
                imageIV.setImage(Image.createImage(selectedImage));
            } catch (IOException e) {
                e.printStackTrace();
            }
            selectImageButton.setText("Modifier l'image");
        });

        manageButton.addActionListener(action -> {
            if (controleDeSaisie()) {
                int responseCode = CommentaireService.getInstance().add(
                        new Commentaire(
                                MainApp.getSession(),
                                selectedPost,
                                selectedImage,
                                descriptionTF.getText(),
                                dateTF.getPicker().getDate(),
                                analyseTF.getText(),
                                datecTsTF.getPicker().getDate()
                        )
                );
                if (responseCode == 200) {
                    Dialog.show("Succés", "Commentaire ajouté avec succes", new Command("Ok"));
                    showBackAndRefresh();
                } else {
                    Dialog.show("Erreur", "Erreur d'ajout de commentaire. Code d'erreur : " + responseCode, new Command("Ok"));
                }
            }
        });
    }

    private void showBackAndRefresh() {
        try {
            ((AfficherToutCommentaire) previous).refresh();
        } catch (ClassCastException e) {
            ((AfficherToutPost) previous).refresh();
        }
        previous.showBack();
    }

    private boolean controleDeSaisie() {


        if (descriptionTF.getText().equals("")) {
            Dialog.show("Avertissement", "Description vide", new Command("Ok"));
            return false;
        }


        if (dateTF.getPicker().getDate() == null) {
            Dialog.show("Avertissement", "Veuillez saisir la date", new Command("Ok"));
            return false;
        }


        if (analyseTF.getText().equals("")) {
            Dialog.show("Avertissement", "Analyse vide", new Command("Ok"));
            return false;
        }


        if (datecTsTF.getPicker().getDate() == null) {
            Dialog.show("Avertissement", "Veuillez saisir la datecTs", new Command("Ok"));
            return false;
        }


        if (selectedPost == null) {
            Dialog.show("Avertissement", "Veuillez choisir un post", new Command("Ok"));
            return false;
        }


        if (selectedImage == null) {
            Dialog.show("Avertissement", "Veuillez choisir une image", new Command("Ok"));
            return false;
        }


        return true;
    }
}