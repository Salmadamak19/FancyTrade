package com.fancytrade.gui.back.event;


import Entity.Event;
import com.codename1.ui.*;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.fancytrade.services.EventService;
import com.fancytrade.utils.Statics;

import java.util.ArrayList;
import java.util.Collections;

public class AfficherToutEvent extends Form {

    Form previous;

    Resources theme = UIManager.initFirstTheme("/theme");

    public static Event currentEvent = null;


    PickerComponent sortPicker;
    ArrayList<Component> componentModels;

    public AfficherToutEvent(Form previous) {
        super(new BoxLayout(BoxLayout.Y_AXIS));
        this.previous = previous;

        addGUIs();
        addActions();

        super.getToolbar().addMaterialCommandToLeftBar("  ", FontImage.MATERIAL_ARROW_BACK, e -> previous.showBack());
    }

    public void refresh() {
        this.removeAll();
        addGUIs();
        addActions();
        this.refreshTheme();
    }

private void addGUIs() {
    ArrayList<Event> events = EventService.getInstance().getAll();

    componentModels = new ArrayList<>();

    sortPicker = PickerComponent.createStrings("Name", "Description").label("Trier par");
    sortPicker.getPicker().setSelectedString("");
    sortPicker.getPicker().addActionListener((l) -> {
        if (componentModels.size() > 0) {
            for (Component componentModel : componentModels) {
                this.removeComponent(componentModel);
            }
        }
        componentModels = new ArrayList<>();
        Statics.compareVar = sortPicker.getPicker().getSelectedString();
        Collections.sort(events);
        for (Event event : events) {
            Component model = makeEventModel(event);
            this.add(model);
            componentModels.add(model);
        }
        this.revalidate();
    });
    this.add(sortPicker);

    if (events.size() > 0) {
        for (Event event : events) {
            Component model = makeEventModel(event);
            this.add(model);
            componentModels.add(model);
        }
    } else {
        this.add(new Label("Aucune donnée"));
    }
}


    private void addActions() {

}

Label nameLabel, descriptionLabel,placeLabel,organiserLabel;

private Container makeModelWithoutButtons(Event event) {
    Container eventPlaceModel = new Container(new BoxLayout(BoxLayout.Y_AXIS));
    eventPlaceModel.setUIID("containerRounded");

    nameLabel = new Label("Name: " + event.getName());
    nameLabel.setUIID("labelDefault");

    descriptionLabel = new Label("Description: " + event.getDescription());
    descriptionLabel.setUIID("labelDefault");
    
        placeLabel = new Label("Place: " + event.getPlace().getName());
    placeLabel.setUIID("labelDefault");
    
        organiserLabel = new Label("organiser: " + event.getOrganiser());
    organiserLabel.setUIID("labelDefault");


    eventPlaceModel.addAll(nameLabel, descriptionLabel,placeLabel,organiserLabel);

    return eventPlaceModel;
}


    private Component makeEventModel(Event event) {


        return makeModelWithoutButtons(event);
    }

}