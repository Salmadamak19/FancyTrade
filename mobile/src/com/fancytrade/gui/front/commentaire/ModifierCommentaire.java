package com.fancytrade.gui.front.commentaire;


import com.codename1.capture.Capture;
import com.codename1.components.ImageViewer;
import com.codename1.ui.*;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.fancytrade.MainApp;
import com.fancytrade.entities.Commentaire;
import com.fancytrade.gui.front.post.AfficherToutPost;
import com.fancytrade.services.CommentaireService;
import com.fancytrade.utils.Statics;

import java.io.IOException;

public class ModifierCommentaire extends Form {


    Resources theme = UIManager.initFirstTheme("/theme");
    String selectedImage;
    boolean imageEdited = false;


    Commentaire currentCommentaire;

    TextField imageTF;
    TextField descriptionTF;
    TextField analyseTF;
    Label imageLabel;
    Label descriptionLabel;
    Label analyseLabel;
    PickerComponent dateTF;
    PickerComponent datecTsTF;

    ImageViewer imageIV;
    Button selectImageButton;

    Button manageButton;

    Form previous;

    public ModifierCommentaire(Form previous) {
        super("Modifier", new BoxLayout(BoxLayout.Y_AXIS));
        this.previous = previous;

        currentCommentaire = AfficherToutCommentaire.currentCommentaire;

        addGUIs();
        addActions();


        getToolbar().addMaterialCommandToLeftBar("  ", FontImage.MATERIAL_ARROW_BACK, e -> previous.showBack());
    }

    private void addGUIs() {


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


        descriptionTF.setText(currentCommentaire.getDescription());
        dateTF.getPicker().setDate(currentCommentaire.getDate());
        analyseTF.setText(currentCommentaire.getAnalyse());
        datecTsTF.getPicker().setDate(currentCommentaire.getDatecTs());

        if (currentCommentaire.getImage() != null) {
            selectedImage = currentCommentaire.getImage();
            String url = Statics.COMMENTAIRE_IMAGE_URL + currentCommentaire.getImage();
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


                descriptionLabel, descriptionTF,
                dateTF,
                analyseLabel, analyseTF,
                datecTsTF,
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
                int responseCode = CommentaireService.getInstance().edit(
                        new Commentaire(
                                currentCommentaire.getId(),
                                MainApp.getSession(),
                                currentCommentaire.getPost(),
                                selectedImage,
                                descriptionTF.getText(),
                                dateTF.getPicker().getDate(),
                                analyseTF.getText(),
                                datecTsTF.getPicker().getDate()

                        ), imageEdited
                );
                if (responseCode == 200) {
                    Dialog.show("Succés", "Commentaire modifié avec succes", new Command("Ok"));
                    showBackAndRefresh();
                } else {
                    Dialog.show("Erreur", "Erreur de modification de commentaire. Code d'erreur : " + responseCode, new Command("Ok"));
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

        if (selectedImage == null) {
            Dialog.show("Avertissement", "Veuillez choisir une image", new Command("Ok"));
            return false;
        }


        return true;
    }
}