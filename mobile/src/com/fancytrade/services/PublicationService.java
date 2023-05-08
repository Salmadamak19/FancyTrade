package com.fancytrade.services;

import com.codename1.components.InfiniteProgress;
import com.codename1.io.*;
import com.codename1.ui.events.ActionListener;
import com.fancytrade.entities.Publication;
import com.fancytrade.entities.User;
import com.fancytrade.utils.Statics;

import java.io.IOException;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

public class PublicationService {

    public static PublicationService instance = null;
    public int resultCode;
    private ConnectionRequest cr;
    private ArrayList<Publication> listPublications;


    private PublicationService() {
        cr = new ConnectionRequest();
    }

    public static PublicationService getInstance() {
        if (instance == null) {
            instance = new PublicationService();
        }
        return instance;
    }

    public ArrayList<Publication> getAll() {
        listPublications = new ArrayList<>();

        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URL + "/publication");
        cr.setHttpMethod("GET");

        cr.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {

                if (cr.getResponseCode() == 200) {
                    listPublications = getList();
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

        return listPublications;
    }

    private ArrayList<Publication> getList() {
        try {
            Map<String, Object> parsedJson = new JSONParser().parseJSON(new CharArrayReader(
                    new String(cr.getResponseData()).toCharArray()
            ));
            List<Map<String, Object>> list = (List<Map<String, Object>>) parsedJson.get("root");

            for (Map<String, Object> obj : list) {
                Publication publication = new Publication(
                        (int) Float.parseFloat(obj.get("id").toString()),

                        makeUser((Map<String, Object>) obj.get("user")),
                        (String) obj.get("content"),
                        new SimpleDateFormat("dd-MM-yyyy").parse((String) obj.get("date")),
                        (String) obj.get("image")

                );

                listPublications.add(publication);
            }
        } catch (IOException | ParseException e) {
            e.printStackTrace();
        }
        return listPublications;
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

    public int add(Publication publication) {

        MultipartRequest cr = new MultipartRequest();
        cr.setFilename("file", "Publication.jpg");


        cr.setHttpMethod("POST");
        cr.setUrl(Statics.BASE_URL + "/publication/add");

        try {
            cr.addData("file", publication.getImage(), "image/jpeg");
        } catch (IOException e) {
            e.printStackTrace();
        }
        cr.addArgumentNoEncoding("image", publication.getImage());

        cr.addArgumentNoEncoding("user", String.valueOf(publication.getUser().getId()));
        cr.addArgumentNoEncoding("content", publication.getContent());
        cr.addArgumentNoEncoding("date", new SimpleDateFormat("dd-MM-yyyy").format(publication.getDate()));
        cr.addArgumentNoEncoding("image", publication.getImage());


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

    public int edit(Publication publication, boolean imageEdited) {

        MultipartRequest cr = new MultipartRequest();
        cr.setFilename("file", "Publication.jpg");

        cr.setHttpMethod("POST");
        cr.setUrl(Statics.BASE_URL + "/publication/edit");
        cr.addArgumentNoEncoding("id", String.valueOf(publication.getId()));

        if (imageEdited) {
            try {
                cr.addData("file", publication.getImage(), "image/jpeg");
            } catch (IOException e) {
                e.printStackTrace();
            }
        } else {
            cr.addArgumentNoEncoding("image", publication.getImage());
        }

        cr.addArgumentNoEncoding("user", String.valueOf(publication.getUser().getId()));
        cr.addArgumentNoEncoding("content", publication.getContent());
        cr.addArgumentNoEncoding("date", new SimpleDateFormat("dd-MM-yyyy").format(publication.getDate()));
        cr.addArgumentNoEncoding("image", publication.getImage());


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

    public int delete(int publicationId) {
        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URL + "/publication/delete");
        cr.setHttpMethod("POST");
        cr.addArgument("id", String.valueOf(publicationId));

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
