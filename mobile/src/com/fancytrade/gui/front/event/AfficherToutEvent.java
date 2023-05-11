package com.fancytrade.gui.front.event;

import Entity.Event;
import com.codename1.components.ImageViewer;
import com.codename1.components.InteractionDialog;
import com.codename1.ui.*;
import com.codename1.ui.layouts.BorderLayout;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.fancytrade.gui.uikit.SideMenuBaseForm;
import com.fancytrade.services.EventService;
import com.fancytrade.utils.Statics;
import java.text.SimpleDateFormat;
import java.util.ArrayList;

public class AfficherToutEvent extends SideMenuBaseForm {

    Form previous;

    Resources theme = UIManager.initFirstTheme("/theme");

    public static Event currentEvent = null;

    Button addBtn;

    public AfficherToutEvent(Resources res) {
        super(new BoxLayout(BoxLayout.Y_AXIS));

        Toolbar tb = new Toolbar(true);
        tb.setUIID("CustomToolbar");
        setToolbar(tb);
        getTitleArea().setUIID("Container");
        setTitle("Events");
        getContentPane().setScrollVisible(false);

        super.addSideMenu(res);
       
        addGUIs();
         addActions();

    }

    public void refresh() {
        this.removeAll();
        addGUIs();
        addActions();
        this.refreshTheme();
    }

    private void addGUIs() {

        Container container = new Container();
        container.setPreferredH(250);
        this.add(container);

        addBtn = new Button("Ajouter");

        this.add(addBtn);

        ArrayList<Event> listEvents = EventService.getInstance().getAll();

        if (listEvents.size() > 0) {
            for (Event event : listEvents) {
                Component model = makeEventModel(event);
                this.add(model);
            }
        } else {
            this.add(new Label("Aucune donnée"));
        }
    }

    private void addActions() {
            if (addBtn == null) {
        addBtn = new Button("Ajouter2");
        this.add(addBtn);
    }
        addBtn.addActionListener(action -> {
            currentEvent = null;
            new AjouterEvent(this).show();
        });

    }
    Label nameLabel, descriptionLabel, placeLabel, imageLabel, dateLabel, organiserLabel;
    ImageViewer imageIV;

    private Container makeModelWithoutButtons(Event event) {
        Container eventModel = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        eventModel.setUIID("containerRounded");

        nameLabel = new Label("Nom : " + event.getName());
        nameLabel.setUIID("labelDefault");

        descriptionLabel = new Label("Description : " + event.getDescription());
        descriptionLabel.setUIID("labelDefault");

        placeLabel = new Label("Lieu : " + event.getPlace().getName());
        placeLabel.setUIID("labelDefault");

        imageLabel = new Label("Image : " + event.getImage());
        imageLabel.setUIID("labelDefault");

        dateLabel = new Label("Date et heure : " + new SimpleDateFormat("dd-MM-yyyy HH:mm").format(event.getDateAndTime()));
        dateLabel.setUIID("labelDefault");

        organiserLabel = new Label("Organisateur : " + event.getOrganiser());
        organiserLabel.setUIID("labelDefault");

        if (event.getImage() != null) {
            String url = Statics.EVENT_IMAGE_URL + event.getImage();
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

        eventModel.addAll(
                imageIV,
                nameLabel, descriptionLabel, placeLabel, imageLabel, dateLabel, organiserLabel
        );

        return eventModel;
    }
       Button editBtn, deleteBtn;
    Container btnsContainer;

    private Component makeEventModel(Event event) {

        Container eventModel = makeModelWithoutButtons(event);

        btnsContainer = new Container(new BorderLayout());
        btnsContainer.setUIID("containerButtons");

        editBtn = new Button("Modifier");

        editBtn.addActionListener(action -> {
            currentEvent = event;
            new ModifierEvent(this).show();
        });

        deleteBtn = new Button("Supprimer");

        deleteBtn.addActionListener(action -> {
            InteractionDialog dlg = new InteractionDialog("Confirmer la suppression");
            dlg.setLayout(new BorderLayout());
            dlg.add(BorderLayout.CENTER, new Label("Voulez vous vraiment supprimer ce event ?"));
            Button btnClose = new Button("Annuler");
            btnClose.addActionListener((ee) -> dlg.dispose());
            Button btnConfirm = new Button("Confirmer");
            btnConfirm.addActionListener(actionConf -> {
                int responseCode = EventService.getInstance().delete(event.getId());

                if (responseCode == 200) {
                    currentEvent = null;
                    dlg.dispose();
                    eventModel.remove();
                    this.refreshTheme();
                } else {
                    Dialog.show("Erreur", "Erreur de suppression du event. Code d'erreur : " + responseCode, new Command("Ok"));
                }
            });
            Container btnContainer = new Container(new BoxLayout(BoxLayout.X_AXIS));
            btnContainer.addAll(btnClose, btnConfirm);
            dlg.addComponent(BorderLayout.SOUTH, btnContainer);
            dlg.show(800, 800, 0, 0);
        });

        btnsContainer.add(BorderLayout.WEST, editBtn);
        btnsContainer.add(BorderLayout.CENTER, deleteBtn);

        eventModel.add(btnsContainer);


        return eventModel;
    }

}
