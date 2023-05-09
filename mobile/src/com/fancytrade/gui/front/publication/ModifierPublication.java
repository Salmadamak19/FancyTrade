package com.fancytrade.gui.front.publication;


import com.codename1.capture.Capture;
import com.codename1.components.ImageViewer;
import com.codename1.ui.*;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.fancytrade.MainApp;
import com.fancytrade.entities.Publication;
import com.fancytrade.services.PublicationService;
import com.fancytrade.utils.AlertUtils;
import com.fancytrade.utils.Statics;

import java.io.IOException;

public class ModifierPublication extends Form {


    Resources theme = UIManager.initFirstTheme("/theme");
    String selectedImage;
    boolean imageEdited = false;


    Publication currentPublication;

    TextField contentTF;
    TextField imageTF;
    Label contentLabel;
    Label imageLabel;
    PickerComponent dateTF;

    ImageViewer imageIV;
    Button selectImageButton;

    Button manageButton;

    Form previous;

    public ModifierPublication(Form previous) {
        super("Modifier", new BoxLayout(BoxLayout.Y_AXIS));
        this.previous = previous;

        currentPublication = AfficherToutPublication.currentPublication;

        addGUIs();
        addActions();


        getToolbar().addMaterialCommandToLeftBar("  ", FontImage.MATERIAL_ARROW_BACK, e -> previous.showBack());
    }

    private void addGUIs() {

        contentLabel = new Label("Content : ");
        contentLabel.setUIID("labelDefault");
        contentTF = new TextField();
        contentTF.setHint("Tapez le content");


        dateTF = PickerComponent.createDate(null).label("Date");


        imageLabel = new Label("Image : ");
        imageLabel.setUIID("labelDefault");
        selectImageButton = new Button("Ajouter une image");


        contentTF.setText(currentPublication.getContent());
        dateTF.getPicker().setDate(currentPublication.getDate());


        if (currentPublication.getImage() != null) {
            selectedImage = currentPublication.getImage();
            String url = Statics.PUBLICATION_IMAGE_URL + currentPublication.getImage();
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

                contentLabel, contentTF,
                dateTF,

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
                int responseCode = PublicationService.getInstance().edit(
                        new Publication(
                                currentPublication.getId(),


                                MainApp.getSession(),
                                contentTF.getText(),
                                dateTF.getPicker().getDate(),
                                selectedImage

                        ), imageEdited
                );
                if (responseCode == 200) {
                    AlertUtils.makeNotification("Publication modifié avec succes");
                    showBackAndRefresh();
                } else {
                    Dialog.show("Erreur", "Erreur de modification de publication. Code d'erreur : " + responseCode, new Command("Ok"));
                }
            }
        });
    }

    private void showBackAndRefresh() {
        ((AfficherToutPublication) previous).refresh();
        previous.showBack();
    }

    private boolean controleDeSaisie() {


        if (contentTF.getText().equals("")) {
            Dialog.show("Avertissement", "Content vide", new Command("Ok"));
            return false;
        }


        if (dateTF.getPicker().getDate() == null) {
            Dialog.show("Avertissement", "Veuillez saisir la date", new Command("Ok"));
            return false;
        }


        if (selectedImage == null) {
            Dialog.show("Avertissement", "Veuillez choisir une image", new Command("Ok"));
            return false;
        }


        return true;
    }
}