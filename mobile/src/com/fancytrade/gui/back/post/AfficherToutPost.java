package com.fancytrade.gui.back.post;


import com.codename1.components.ImageViewer;
import com.codename1.ui.*;
import com.codename1.ui.layouts.BoxLayout;
import com.codename1.ui.plaf.UIManager;
import com.codename1.ui.util.Resources;
import com.fancytrade.entities.Post;
import com.fancytrade.services.PostService;
import com.fancytrade.utils.Statics;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Collections;

public class AfficherToutPost extends Form {

    Form previous;

    Resources theme = UIManager.initFirstTheme("/theme");

    public static Post currentPost = null;


    PickerComponent sortPicker;
    ArrayList<Component> componentModels;

    public AfficherToutPost(Form previous) {
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


        ArrayList<Post> listPosts = PostService.getInstance().getAll();

        componentModels = new ArrayList<>();

        sortPicker = PickerComponent.createStrings("User", "Sujet", "Description", "NbrJaime", "Image", "Date", "Communaute", "Analyse", "Liked", "Badlevel").label("Trier par");
        sortPicker.getPicker().setSelectedString("");
        sortPicker.getPicker().addActionListener((l) -> {
            if (componentModels.size() > 0) {
                for (Component componentModel : componentModels) {
                    this.removeComponent(componentModel);
                }
            }
            componentModels = new ArrayList<>();
            Statics.compareVar = sortPicker.getPicker().getSelectedString();
            Collections.sort(listPosts);
            for (Post post : listPosts) {
                Component model = makePostModel(post);
                this.add(model);
                componentModels.add(model);
            }
            this.revalidate();
        });
        this.add(sortPicker);

        if (listPosts.size() > 0) {
            for (Post post : listPosts) {
                Component model = makePostModel(post);
                this.add(model);
                componentModels.add(model);
            }
        } else {
            this.add(new Label("Aucune donnée"));
        }
    }

    private void addActions() {

    }

    Label userLabel, sujetLabel, descriptionLabel, nbrJaimeLabel, imageLabel, dateLabel, communauteLabel, analyseLabel, likedLabel, badlevelLabel;

    ImageViewer imageIV;


    private Container makeModelWithoutButtons(Post post) {
        Container postModel = new Container(new BoxLayout(BoxLayout.Y_AXIS));
        postModel.setUIID("containerRounded");


        userLabel = new Label("User : " + post.getUser());
        userLabel.setUIID("labelDefault");

        sujetLabel = new Label("Sujet : " + post.getSujet());
        sujetLabel.setUIID("labelDefault");

        descriptionLabel = new Label("Description : " + post.getDescription());
        descriptionLabel.setUIID("labelDefault");

        nbrJaimeLabel = new Label("NbrJaime : " + post.getNbrJaime());
        nbrJaimeLabel.setUIID("labelDefault");

        imageLabel = new Label("Image : " + post.getImage());
        imageLabel.setUIID("labelDefault");

        dateLabel = new Label("Date : " + new SimpleDateFormat("dd-MM-yyyy").format(post.getDate()));
        dateLabel.setUIID("labelDefault");

        communauteLabel = new Label("Communaute : " + post.getCommunaute());
        communauteLabel.setUIID("labelDefault");

        analyseLabel = new Label("Analyse : " + post.getAnalyse());
        analyseLabel.setUIID("labelDefault");

        likedLabel = new Label("Liked : " + post.getLiked());
        likedLabel.setUIID("labelDefault");

        badlevelLabel = new Label("Badlevel : " + post.getBadlevel());
        badlevelLabel.setUIID("labelDefault");

        userLabel = new Label("User : " + post.getUser().getEmail());
        userLabel.setUIID("labelDefault");

        if (post.getImage() != null) {
            String url = Statics.POST_IMAGE_URL + post.getImage();
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

        postModel.addAll(
                imageIV,
                userLabel, sujetLabel, descriptionLabel, nbrJaimeLabel, dateLabel, communauteLabel, analyseLabel, likedLabel, badlevelLabel
        );

        return postModel;
    }

    private Component makePostModel(Post post) {


        return makeModelWithoutButtons(post);
    }

}