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

import java.io.IOException;

public class AjouterPublication extends Form {


    Resources theme = UIManager.initFirstTheme("/theme");
    String selectedImage;
    boolean imageEdited = false;


    TextField contentTF;
    TextField imageTF;
    Label contentLabel;
    Label imageLabel;
    PickerComponent dateTF;

    ImageViewer imageIV;
    Button selectImageButton;

    Button manageButton;

    Form previous;

    public AjouterPublication(Form previous) {
        super("Ajouter", new BoxLayout(BoxLayout.Y_AXIS));
        this.previous = previous;

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


        imageIV = new ImageViewer(theme.getImage("user-picture.jpg").fill(1100, 500));


        manageButton = new Button("Ajouter");


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
                int responseCode = PublicationService.getInstance().add(
                        new Publication(


                                MainApp.getSession(),
                                contentTF.getText(),
                                dateTF.getPicker().getDate(),
                                selectedImage
                        )
                );
                if (responseCode == 200) {
                    AlertUtils.makeNotification("Publication ajouté avec succes");
                    showBackAndRefresh();
                } else {
                    Dialog.show("Erreur", "Erreur d'ajout de publication. Code d'erreur : " + responseCode, new Command("Ok"));
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