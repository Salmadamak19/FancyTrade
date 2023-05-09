/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.fancytrade.services;

/**
 *
 * @author oussema
 */
import com.codename1.components.InfiniteProgress;
import com.codename1.io.*;
import com.codename1.ui.events.ActionListener;
import com.fancytrade.entities.EventPlace;
import com.fancytrade.utils.Statics;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.Map;

public class EventPlaceService {

    public static EventPlaceService instance = null;
    public int resultCode;
    private ConnectionRequest cr;
    private ArrayList<EventPlace> listEventPlaces;

    private EventPlaceService() {
        cr = new ConnectionRequest();
    }

    public static EventPlaceService getInstance() {
        if (instance == null) {
            instance = new EventPlaceService();
        }
        return instance;
    }

    public ArrayList<EventPlace> getAll() {
        listEventPlaces = new ArrayList<>();

        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URL + "/eventplace");
        cr.setHttpMethod("GET");

        cr.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                if (cr.getResponseCode() == 200) {
                    listEventPlaces = getList();
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

        return listEventPlaces;
    }

    private ArrayList<EventPlace> getList() {
        try {
            Map<String, Object> parsedJson = new JSONParser().parseJSON(new CharArrayReader(
                    new String(cr.getResponseData()).toCharArray()
            ));
            List<Map<String, Object>> list = (List<Map<String, Object>>) parsedJson.get("root");

            for (Map<String, Object> obj : list) {
                EventPlace eventPlace = new EventPlace(
                        (int) Float.parseFloat(obj.get("id").toString()),
                        (String) obj.get("name"),
                        (String) obj.get("description")
                );

                listEventPlaces.add(eventPlace);
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
        return listEventPlaces;
    }

    public int add(EventPlace eventPlace) {
        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URL + "/eventplace/add");
        cr.setHttpMethod("POST");
        cr.addArgument("name", eventPlace.getName());
        cr.addArgument("description", eventPlace.getDescription());

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
        } catch (Exception e) {
            e.printStackTrace();
        }

        return resultCode;
    }

    public int edit(EventPlace eventPlace) {
        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URL + "/eventplace/edit");
        cr.setHttpMethod("POST");

        cr.addArgumentNoEncoding("id", String.valueOf(eventPlace.getId()));
        cr.addArgumentNoEncoding("name", eventPlace.getName());
        cr.addArgumentNoEncoding("description", eventPlace.getDescription());

        ActionListener<NetworkEvent> responseListener = new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                cr.removeResponseListener(this);
            }
        };

        cr.addResponseListener(responseListener);

        try {
            cr.setDisposeOnCompletion(new InfiniteProgress().showInfiniteBlocking());
            NetworkManager.getInstance().addToQueueAndWait(cr);
        } catch (Exception ignored) {
        }

        return resultCode;
    }

    public int delete(int eventPlaceId) {
        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URL + "/eventplace/delete");
        cr.setHttpMethod("POST");
        cr.addArgument("id", String.valueOf(eventPlaceId));

        ActionListener<NetworkEvent> responseListener = new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                cr.removeResponseListener(this);
            }
        };

        cr.addResponseListener(responseListener);

        try {
            cr.setDisposeOnCompletion(new InfiniteProgress().showInfiniteBlocking());
            NetworkManager.getInstance().addToQueueAndWait(cr);
        } catch (Exception e) {
            e.printStackTrace();
        }

        return cr.getResponseCode();
    }

}
