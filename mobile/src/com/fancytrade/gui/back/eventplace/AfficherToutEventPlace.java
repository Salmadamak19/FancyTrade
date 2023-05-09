package com.fancytrade.gui.back.eventplace;


import com.codename1.components.ImageViewer;
import com.codename1.ui.*;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.fancytrade.entities.EventPlace;
import com.fancytrade.entities.Post;
import com.fancytrade.services.EventPlaceService;
import com.fancytrade.services.PostService;
import com.fancytrade.utils.Statics;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Collections;

public class AfficherToutEventPlace extends Form {

    Form previous;

    Resources theme = UIManager.initFirstTheme("/theme");

    public static Post currentPost = null;


    PickerComponent sortPicker;
    ArrayList<Component> componentModels;

    public AfficherToutEventPlace(Form previous) {
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
    ArrayList<EventPlace> eventPlaces = EventPlaceService.getInstance().getAll();

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
        Collections.sort(eventPlaces);
        for (EventPlace eventPlace : eventPlaces) {
            Component model = makeEventPlaceModel(eventPlace);
            this.add(model);
            componentModels.add(model);
        }
        this.revalidate();
    });
    this.add(sortPicker);

    if (eventPlaces.size() > 0) {
        for (EventPlace eventPlace : eventPlaces) {
            Component model = makeEventPlaceModel(eventPlace);
            this.add(model);
            componentModels.add(model);
        }
    } else {
        this.add(new Label("Aucune donnée"));
    }
}


    private void addActions() {

}

Label nameLabel, descriptionLabel;

private Container makeModelWithoutButtons(EventPlace eventPlace) {
    Container eventPlaceModel = new Container(new BoxLayout(BoxLayout.Y_AXIS));
    eventPlaceModel.setUIID("containerRounded");

    nameLabel = new Label("Name: " + eventPlace.getName());
    nameLabel.setUIID("labelDefault");

    descriptionLabel = new Label("Description: " + eventPlace.getDescription());
    descriptionLabel.setUIID("labelDefault");

    eventPlaceModel.addAll(nameLabel, descriptionLabel);

    return eventPlaceModel;
}


    private Component makeEventPlaceModel(EventPlace eventplace) {


        return makeModelWithoutButtons(eventplace);
    }

}