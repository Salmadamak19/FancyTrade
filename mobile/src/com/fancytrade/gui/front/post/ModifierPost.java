package com.fancytrade.gui.front.post;


import com.codename1.capture.Capture;
import com.codename1.components.ImageViewer;
import com.codename1.ui.*;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.fancytrade.MainApp;
import com.fancytrade.entities.Post;
import com.fancytrade.services.PostService;
import com.fancytrade.utils.Statics;

import java.io.IOException;

public class ModifierPost extends Form {


    Resources theme = UIManager.initFirstTheme("/theme");
    String selectedImage;
    boolean imageEdited = false;


    Post currentPost;

    TextField sujetTF;
    TextField descriptionTF;
    TextField nbrJaimeTF;
    TextField imageTF;
    TextField communauteTF;
    TextField analyseTF;
    TextField likedTF;
    TextField badlevelTF;
    Label sujetLabel;
    Label descriptionLabel;
    Label nbrJaimeLabel;
    Label imageLabel;
    Label communauteLabel;
    Label analyseLabel;
    Label likedLabel;
    Label badlevelLabel;
    PickerComponent dateTF;

    ImageViewer imageIV;
    Button selectImageButton;

    Button manageButton;

    Form previous;

    public ModifierPost(Form previous) {
        super("Modifier", new BoxLayout(BoxLayout.Y_AXIS));
        this.previous = previous;

        currentPost = AfficherToutPost.currentPost;

        addGUIs();
        addActions();


        getToolbar().addMaterialCommandToLeftBar("  ", FontImage.MATERIAL_ARROW_BACK, e -> previous.showBack());
    }

    private void addGUIs() {

        sujetLabel = new Label("Sujet : ");
        sujetLabel.setUIID("labelDefault");
        sujetTF = new TextField();
        sujetTF.setHint("Tapez le sujet");


        descriptionLabel = new Label("Description : ");
        descriptionLabel.setUIID("labelDefault");
        descriptionTF = new TextField();
        descriptionTF.setHint("Tapez le description");


        nbrJaimeLabel = new Label("NbrJaime : ");
        nbrJaimeLabel.setUIID("labelDefault");
        nbrJaimeTF = new TextField();
        nbrJaimeTF.setHint("Tapez le nbrJaime");


        dateTF = PickerComponent.createDate(null).label("Date");


        communauteLabel = new Label("Communaute : ");
        communauteLabel.setUIID("labelDefault");
        communauteTF = new TextField();
        communauteTF.setHint("Tapez le communaute");


        analyseLabel = new Label("Analyse : ");
        analyseLabel.setUIID("labelDefault");
        analyseTF = new TextField();
        analyseTF.setHint("Tapez le analyse");


        likedLabel = new Label("Liked : ");
        likedLabel.setUIID("labelDefault");
        likedTF = new TextField();
        likedTF.setHint("Tapez le liked");


        badlevelLabel = new Label("Badlevel : ");
        badlevelLabel.setUIID("labelDefault");
        badlevelTF = new TextField();
        badlevelTF.setHint("Tapez le badlevel");


        imageLabel = new Label("Image : ");
        imageLabel.setUIID("labelDefault");
        selectImageButton = new Button("Ajouter une image");


        sujetTF.setText(currentPost.getSujet());
        descriptionTF.setText(currentPost.getDescription());
        nbrJaimeTF.setText(String.valueOf(currentPost.getNbrJaime()));

        dateTF.getPicker().setDate(currentPost.getDate());
        communauteTF.setText(currentPost.getCommunaute());
        analyseTF.setText(currentPost.getAnalyse());
        likedTF.setText(String.valueOf(currentPost.getLiked()));
        badlevelTF.setText(String.valueOf(currentPost.getBadlevel()));

        if (currentPost.getImage() != null) {
            selectedImage = currentPost.getImage();
            String url = Statics.POST_IMAGE_URL + currentPost.getImage();
            Image image = URLImage.createToStorage(
                    EncodedImage.createFromImage(theme.getImage("user-picture.jpg").fill(1100, 500), false),
                    url,
                    url,
                    URLImage.RESIZE_SCALE
            );
            imageIV = new ImageViewer(image);
        } else {
            imageIV = new ImageViewer(theme.getImage("user-picture.jpg").fill(1100, 500));
        }
        imageIV.setFocusable(false);


        manageButton = new Button("Modifier");


        Container container = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        container.setUIID("containerRounded");

        container.addAll(
                imageLabel, imageIV,
                selectImageButton,

                sujetLabel, sujetTF,
                descriptionLabel, descriptionTF,
                nbrJaimeLabel, nbrJaimeTF,

                dateTF,
                communauteLabel, communauteTF,
                analyseLabel, analyseTF,
                likedLabel, likedTF,
                badlevelLabel, badlevelTF,
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
                int responseCode = PostService.getInstance().edit(
                        new Post(
                                currentPost.getId(),
                                MainApp.getSession(),
                                sujetTF.getText(),
                                descriptionTF.getText(),
                                (int) Float.parseFloat(nbrJaimeTF.getText()),
                                selectedImage,
                                dateTF.getPicker().getDate(),
                                communauteTF.getText(),
                                analyseTF.getText(),
                                (int) Float.parseFloat(likedTF.getText()),
                                (int) Float.parseFloat(badlevelTF.getText())

                        ), imageEdited
                );
                if (responseCode == 200) {
                    Dialog.show("Succés", "Post modifié avec succes", new Command("Ok"));
                    showBackAndRefresh();
                } else {
                    Dialog.show("Erreur", "Erreur de modification de post. Code d'erreur : " + responseCode, new Command("Ok"));
                }
            }
        });
    }

    private void showBackAndRefresh() {
        ((AfficherToutPost) previous).refresh();
        previous.showBack();
    }

    private boolean controleDeSaisie() {


        if (sujetTF.getText().equals("")) {
            Dialog.show("Avertissement", "Sujet vide", new Command("Ok"));
            return false;
        }


        if (descriptionTF.getText().equals("")) {
            Dialog.show("Avertissement", "Description vide", new Command("Ok"));
            return false;
        }


        if (nbrJaimeTF.getText().equals("")) {
            Dialog.show("Avertissement", "NbrJaime vide", new Command("Ok"));
            return false;
        }
        try {
            Float.parseFloat(nbrJaimeTF.getText());
        } catch (NumberFormatException e) {
            Dialog.show("Avertissement", nbrJaimeTF.getText() + " n'est pas un nombre valide (nbrJaime)", new Command("Ok"));
            return false;
        }


        if (dateTF.getPicker().getDate() == null) {
            Dialog.show("Avertissement", "Veuillez saisir la date", new Command("Ok"));
            return false;
        }


        if (communauteTF.getText().equals("")) {
            Dialog.show("Avertissement", "Communaute vide", new Command("Ok"));
            return false;
        }


        if (analyseTF.getText().equals("")) {
            Dialog.show("Avertissement", "Analyse vide", new Command("Ok"));
            return false;
        }


        if (likedTF.getText().equals("")) {
            Dialog.show("Avertissement", "Liked vide", new Command("Ok"));
            return false;
        }
        try {
            Float.parseFloat(likedTF.getText());
        } catch (NumberFormatException e) {
            Dialog.show("Avertissement", likedTF.getText() + " n'est pas un nombre valide (liked)", new Command("Ok"));
            return false;
        }


        if (badlevelTF.getText().equals("")) {
            Dialog.show("Avertissement", "Badlevel vide", new Command("Ok"));
            return false;
        }
        try {
            Float.parseFloat(badlevelTF.getText());
        } catch (NumberFormatException e) {
            Dialog.show("Avertissement", badlevelTF.getText() + " n'est pas un nombre valide (badlevel)", new Command("Ok"));
            return false;
        }


        if (selectedImage == null) {
            Dialog.show("Avertissement", "Veuillez choisir une image", new Command("Ok"));
            return false;
        }


        return true;
    }
}