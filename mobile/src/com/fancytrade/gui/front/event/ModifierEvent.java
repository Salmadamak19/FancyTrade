/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.fancytrade.gui.front.event;

import Entity.Event;
import com.codename1.capture.Capture;
import com.codename1.components.ImageViewer;
import com.codename1.ui.*;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.fancytrade.MainApp;
import com.fancytrade.entities.EventPlace;
import com.fancytrade.entities.Publication;
import com.fancytrade.services.EventPlaceService;
import com.fancytrade.services.EventService;
import com.fancytrade.services.PublicationService;
import com.fancytrade.utils.AlertUtils;
import com.fancytrade.utils.Statics;

import java.io.IOException;
import java.util.ArrayList;

public class ModifierEvent extends Form {


    Resources theme = UIManager.initFirstTheme("/theme");
    String selectedImage;
    boolean imageEdited = false;
    Event currentEvent;

    TextField imageTF;
    TextField nameTF;
    TextField descriptionTF;
    TextField organiserTF;
    Label nameLabel;
    Label descriptionLabel;
    Label organiserLabel;
    Label imageLabel;
    PickerComponent dateTF;
    ComboBox<EventPlace> eventPlacesComboBox;
    ImageViewer imageIV;
    Button selectImageButton;

    Button manageButton;

    Form previous;

    public ModifierEvent(Form previous) {
        super("Modifier", new BoxLayout(BoxLayout.Y_AXIS));
        this.previous = previous;

        currentEvent = AfficherToutEvent.currentEvent;

        addGUIs();
        addActions();


        getToolbar().addMaterialCommandToLeftBar("  ", FontImage.MATERIAL_ARROW_BACK, e -> previous.showBack());
    }

    private void addGUIs() {

        nameLabel = new Label("Name : ");
        nameLabel.setUIID("labelDefault");
        nameTF = new TextField();
        nameTF.setHint("Tapez le Name");

        descriptionLabel = new Label("Description : ");
        descriptionLabel.setUIID("labelDefault");
        descriptionTF = new TextField();
        descriptionTF.setHint("Tapez le description");

        organiserLabel = new Label("Organiser : ");
        organiserLabel.setUIID("labelDefault");
        organiserTF = new TextField();
        organiserTF.setHint("Tapez le organiser");

        eventPlacesComboBox = new ComboBox<>();

        // Get the list of event places
        ArrayList<EventPlace> eventPlaces = EventPlaceService.getInstance().getAll();

        // Add the names of event places to the ComboBox
        for (EventPlace eventPlace : eventPlaces) {
            eventPlacesComboBox.addItem(eventPlace);
        }
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
                nameLabel, nameTF,
                descriptionLabel, descriptionTF,
                organiserLabel, organiserTF,
                eventPlacesComboBox,
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
                int responseCode = EventService.getInstance().edit(
                        new Event(
                                currentEvent.getId(),
                                nameTF.getText(),
                                descriptionTF.getText(),
                                eventPlacesComboBox.getSelectedItem(),
                                selectedImage,
                                dateTF.getPicker().getDate(),
                                MainApp.getSession(),
                                organiserTF.getText()

                        ), imageEdited
                );
                if (responseCode == 200) {
                    AlertUtils.makeNotification("Event modifié avec succes");
                    showBackAndRefresh();
                } else {
                    Dialog.show("Erreur", "Erreur de modification de event. Code d'erreur : " + responseCode, new Command("Ok"));
                }
            }
        });
    }

    private void showBackAndRefresh() {
        ((AfficherToutEvent) previous).refresh();
        previous.showBack();
    }

    private boolean controleDeSaisie() {


       /* if (contentTF.getText().equals("")) {
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
        }*/


        return true;
    }
}