/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.fancytrade.gui.front.event;

import Entity.Event;
import com.codename1.ui.*;

import com.codename1.capture.Capture;
import com.codename1.components.ImageViewer;
import com.codename1.ui.Button;
import com.codename1.ui.Command;
import com.codename1.ui.Container;
import com.codename1.ui.Dialog;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.Image;
import com.codename1.ui.Label;
import com.codename1.ui.PickerComponent;
import com.codename1.ui.TextField;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.fancytrade.MainApp;
import com.fancytrade.entities.EventPlace;
import com.fancytrade.services.EventPlaceService;
import com.fancytrade.services.EventService;
import com.fancytrade.utils.AlertUtils;
import java.io.IOException;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.Calendar;

public class AjouterEvent extends Form {

    Resources theme = UIManager.initFirstTheme("/theme");
    String selectedImage;
    boolean imageEdited = false;

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

    public AjouterEvent(Form previous) {
        super("Ajouter", new BoxLayout(BoxLayout.Y_AXIS));
        this.previous = previous;

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
System.out.println("Selected Date with Fixed Time: " + nameTF.getText());
System.out.println("Selected Date with Fixed Time: " + descriptionTF.getText());
System.out.println("Selected Date with Fixed Time: " + eventPlacesComboBox.getSelectedItem());
System.out.println("Selected Date with Fixed Time: " + selectedImage);
System.out.println("Selected Date with Fixed Time: " + new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(dateTF.getPicker().getDate()));
System.out.println("Selected Date with Fixed Time: " + MainApp.getSession());
System.out.println("Selected Date with Fixed Time: " + organiserTF.getText());

                int responseCode = EventService.getInstance().add(
                        new Event(
                                nameTF.getText(),
                                descriptionTF.getText(),
                                eventPlacesComboBox.getSelectedItem(),
                                selectedImage,
                                dateTF.getPicker().getDate(),
                                MainApp.getSession(),
                                organiserTF.getText()
                        )
                );
                if (responseCode == 200) {
                    AlertUtils.makeNotification("Event ajouté avec succes");
                    showBackAndRefresh();
                } else {
                    Dialog.show("Erreur", "Erreur d'ajout de event. Code d'erreur : " + responseCode, new Command("Ok"));
                }
            }
        });
    }

    private void showBackAndRefresh() {
        ((AfficherToutEvent) previous).refresh();
        previous.showBack();
    }

    private boolean controleDeSaisie() {

        /*  if (contentTF.getText().equals("")) {
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
