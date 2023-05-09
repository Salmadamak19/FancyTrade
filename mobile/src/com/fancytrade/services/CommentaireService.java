package com.fancytrade.services;

import com.codename1.components.InfiniteProgress;
import com.codename1.io.*;
import com.codename1.ui.events.ActionListener;
import com.fancytrade.entities.Commentaire;
import com.fancytrade.entities.Post;
import com.fancytrade.entities.User;
import com.fancytrade.utils.Statics;

import java.io.IOException;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

public class CommentaireService {

    public static CommentaireService instance = null;
    public int resultCode;
    private ConnectionRequest cr;
    private ArrayList<Commentaire> listCommentaires;


    private CommentaireService() {
        cr = new ConnectionRequest();
    }

    public static CommentaireService getInstance() {
        if (instance == null) {
            instance = new CommentaireService();
        }
        return instance;
    }

    public ArrayList<Commentaire> getAll() {
        listCommentaires = new ArrayList<>();

        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URL + "/commentaire");
        cr.setHttpMethod("GET");

        cr.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {

                if (cr.getResponseCode() == 200) {
                    listCommentaires = getList();
                }

                cr.removeResponseListener(this);
            }
        });

        try {
            cr.setDisposeOnCompletion(new InfiniteProgress().showInfiniteBlocking());
            NetworkManager.getInstance().addToQueueAndWait(cr);
        } catch (Exception e) {
            e.printStackTrace();
        }

        return listCommentaires;
    }

    private ArrayList<Commentaire> getList() {
        try {
            Map<String, Object> parsedJson = new JSONParser().parseJSON(new CharArrayReader(
                    new String(cr.getResponseData()).toCharArray()
            ));
            List<Map<String, Object>> list = (List<Map<String, Object>>) parsedJson.get("root");

            for (Map<String, Object> obj : list) {
                Commentaire commentaire = new Commentaire(
                        (int) Float.parseFloat(obj.get("id").toString()),

                        makeUser((Map<String, Object>) obj.get("user")),
                        makePost((Map<String, Object>) obj.get("post")),
                        (String) obj.get("image"),
                        (String) obj.get("description"),
                        new SimpleDateFormat("dd-MM-yyyy").parse((String) obj.get("date")),
                        (String) obj.get("analyse"),
                        new SimpleDateFormat("dd-MM-yyyy").parse((String) obj.get("datecTs"))

                );

                listCommentaires.add(commentaire);
            }
        } catch (IOException | ParseException e) {
            e.printStackTrace();
        }
        return listCommentaires;
    }

    public User makeUser(Map<String, Object> obj) {
        if (obj == null) {
            return null;
        }
        User user = new User();
        user.setId((int) Float.parseFloat(obj.get("id").toString()));
        user.setEmail((String) obj.get("email"));
        return user;
    }

    public Post makePost(Map<String, Object> obj) {
        if (obj == null) {
            return null;
        }
        Post post = new Post();
        post.setId((int) Float.parseFloat(obj.get("id").toString()));
        post.setSujet((String) obj.get("sujet"));
        return post;
    }

    public int add(Commentaire commentaire) {

        MultipartRequest cr = new MultipartRequest();
        cr.setFilename("file", "Commentaire.jpg");


        cr.setHttpMethod("POST");
        cr.setUrl(Statics.BASE_URL + "/commentaire/add");

        try {
            cr.addData("file", commentaire.getImage(), "image/jpeg");
        } catch (IOException e) {
            e.printStackTrace();
        }
        cr.addArgumentNoEncoding("image", commentaire.getImage());

        cr.addArgumentNoEncoding("user", String.valueOf(commentaire.getUser().getId()));
        cr.addArgumentNoEncoding("post", String.valueOf(commentaire.getPost().getId()));
        cr.addArgumentNoEncoding("image", commentaire.getImage());
        cr.addArgumentNoEncoding("description", commentaire.getDescription());
        cr.addArgumentNoEncoding("date", new SimpleDateFormat("dd-MM-yyyy").format(commentaire.getDate()));
        cr.addArgumentNoEncoding("analyse", commentaire.getAnalyse());
        cr.addArgumentNoEncoding("datecTs", new SimpleDateFormat("dd-MM-yyyy").format(commentaire.getDatecTs()));


        cr.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultCode = cr.getResponseCode();
                cr.removeResponseListener(this);
            }
        });
        try {
            cr.setDisposeOnCompletion(new InfiniteProgress().showInfiniteBlocking());
            NetworkManager.getInstance().addToQueueAndWait(cr);
        } catch (Exception ignored) {

        }
        return resultCode;
    }

    public int edit(Commentaire commentaire, boolean imageEdited) {

        MultipartRequest cr = new MultipartRequest();
        cr.setFilename("file", "Commentaire.jpg");

        cr.setHttpMethod("POST");
        cr.setUrl(Statics.BASE_URL + "/commentaire/edit");
        cr.addArgumentNoEncoding("id", String.valueOf(commentaire.getId()));

        if (imageEdited) {
            try {
                cr.addData("file", commentaire.getImage(), "image/jpeg");
            } catch (IOException e) {
                e.printStackTrace();
            }
        } else {
            cr.addArgumentNoEncoding("image", commentaire.getImage());
        }

        cr.addArgumentNoEncoding("user", String.valueOf(commentaire.getUser().getId()));
        cr.addArgumentNoEncoding("post", String.valueOf(commentaire.getPost().getId()));
        cr.addArgumentNoEncoding("image", commentaire.getImage());
        cr.addArgumentNoEncoding("description", commentaire.getDescription());
        cr.addArgumentNoEncoding("date", new SimpleDateFormat("dd-MM-yyyy").format(commentaire.getDate()));
        cr.addArgumentNoEncoding("analyse", commentaire.getAnalyse());
        cr.addArgumentNoEncoding("datecTs", new SimpleDateFormat("dd-MM-yyyy").format(commentaire.getDatecTs()));


        cr.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultCode = cr.getResponseCode();
                cr.removeResponseListener(this);
            }
        });
        try {
            cr.setDisposeOnCompletion(new InfiniteProgress().showInfiniteBlocking());
            NetworkManager.getInstance().addToQueueAndWait(cr);
        } catch (Exception ignored) {

        }
        return resultCode;
    }

    public int delete(int commentaireId) {
        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URL + "/commentaire/delete");
        cr.setHttpMethod("POST");
        cr.addArgument("id", String.valueOf(commentaireId));

        cr.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                cr.removeResponseListener(this);
            }
        });

        try {
            cr.setDisposeOnCompletion(new InfiniteProgress().showInfiniteBlocking());
            NetworkManager.getInstance().addToQueueAndWait(cr);
        } catch (Exception e) {
            e.printStackTrace();
        }
        return cr.getResponseCode();
    }
}
