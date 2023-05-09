package com.fancytrade.gui.front.event;


import Entity.Event;
import com.codename1.components.ImageViewer;
import com.codename1.ui.*;
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
        
    }

    public void refresh() {
        this.removeAll();
        addGUIs();
      
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
    Label nameLabel, descriptionLabel, placeLabel, imageLabel, dateLabel, organiserLabel;
ImageViewer imageIV;

private Container makeEventModel(Event event) {
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

}