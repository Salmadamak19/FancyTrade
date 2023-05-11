package com.fancytrade.services;

import Entity.Event;
import com.codename1.components.InfiniteProgress;
import com.codename1.io.*;
import com.codename1.ui.events.ActionListener;
import com.fancytrade.entities.EventPlace;
import com.fancytrade.entities.User;
import com.fancytrade.utils.Statics;

import java.io.IOException;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.Map;

public class EventService {

    public static EventService instance = null;
    public int resultCode;
    private ConnectionRequest cr;
    private ArrayList<Event> listEvents;

    private EventService() {
        cr = new ConnectionRequest();
    }

    public static EventService getInstance() {
        if (instance == null) {
            instance = new EventService();
        }
        return instance;
    }

    public ArrayList<Event> getAll() {
        listEvents = new ArrayList<>();

        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URL + "/event");
        cr.setHttpMethod("GET");

        cr.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {

                if (cr.getResponseCode() == 200) {
                    listEvents = getList();
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

        return listEvents;
    }

private ArrayList<Event> getList() {
    try {
        Map<String, Object> parsedJson = new JSONParser().parseJSON(new CharArrayReader(
                new String(cr.getResponseData()).toCharArray()
        ));
        List<Map<String, Object>> list = (List<Map<String, Object>>) parsedJson.get("root");
        for (Map<String, Object> obj : list) {
            String dateAndTime = ((Map<String, Object>) obj.get("dateAndTime")).get("date").toString();

            Event event = new Event(
                    (int) Float.parseFloat(obj.get("id").toString()),
                    (String) obj.get("name"),
                    (String) obj.get("description"),
                    makeEventPlace((Map<String, Object>) obj.get("place")),
                    (String) obj.get("image"),
                    parseDate(dateAndTime),
                    makeUser((Map<String, Object>) obj.get("user")),
                    (String) obj.get("organiser"),
                    null
            );

            listEvents.add(event);
        }
    } catch (IOException | ParseException e) {
        e.printStackTrace();
    }
    return listEvents;
}

private Date parseDate(String dateAndTime) throws ParseException {
    SimpleDateFormat inputFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss.SSSSSS");
    Date date = inputFormat.parse(dateAndTime);

    // Extract the desired components (date and time)
    SimpleDateFormat outputFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
    String formattedDate = outputFormat.format(date);

    return outputFormat.parse(formattedDate);
}


    public EventPlace makeEventPlace(Map<String, Object> obj) {
        if (obj == null) {
            return null;
        }
        EventPlace place = new EventPlace();
        place.setId((int) Float.parseFloat(obj.get("id").toString()));
        place.setName((String) obj.get("name"));
        place.setDescription((String) obj.get("description"));
        return place;
    }

    public User makeUser(Map<String, Object> obj) {
        if (obj == null) {
            return null;
        }
        User user = new User();
        user.setId((int) Float.parseFloat(obj.get("id").toString()));
        user.setEmail((String) obj.get("email"));
        // Set other properties of User if available
        return user;
    }

    public int add(Event event) {
        MultipartRequest cr = new MultipartRequest();
        cr.setFilename("file", "Event.jpg");
        cr.setHttpMethod("POST");
        cr.setUrl(Statics.BASE_URL + "/event/add");

        try {
            cr.addData("file", event.getImage(), "image/jpeg");
        } catch (IOException e) {
            e.printStackTrace();
        }

        // Set other request arguments
        cr.addArgumentNoEncoding("name", event.getName());
        cr.addArgumentNoEncoding("description", event.getDescription());
        cr.addArgumentNoEncoding("place", String.valueOf(event.getPlace().getId()));
        cr.addArgumentNoEncoding("image", event.getImage());
        cr.addArgumentNoEncoding("dateandtime", new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(event.getDateAndTime()));
        cr.addArgumentNoEncoding("user", String.valueOf(event.getUser().getId()));
        cr.addArgumentNoEncoding("organiser", event.getOrganiser());

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

    public int edit(Event event, boolean imageEdited) {
        MultipartRequest cr = new MultipartRequest();
        cr.setFilename("file", "Event.jpg");
        cr.setHttpMethod("POST");
        cr.setUrl(Statics.BASE_URL + "/event/edit");
        cr.addArgumentNoEncoding("id", String.valueOf(event.getId()));

        if (imageEdited) {
            try {
                cr.addData("file", event.getImage(), "image/jpeg");
            } catch (IOException e) {
                e.printStackTrace();
            }
        } else {
            cr.addArgumentNoEncoding("image", event.getImage());
        }

        // Set other request arguments
        cr.addArgumentNoEncoding("name", event.getName());
        cr.addArgumentNoEncoding("description", event.getDescription());
        cr.addArgumentNoEncoding("place", String.valueOf(event.getPlace().getId()));
        cr.addArgumentNoEncoding("image", event.getImage());
        cr.addArgumentNoEncoding("dateandtime", new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(event.getDateAndTime()));
        cr.addArgumentNoEncoding("user", String.valueOf(event.getUser().getId()));
        cr.addArgumentNoEncoding("organiser", event.getOrganiser());

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

    public int delete(int eventId) {
        cr = new ConnectionRequest();
        cr.setUrl(Statics.BASE_URL + "/event/delete");
        cr.setHttpMethod("POST");
        cr.addArgument("id", String.valueOf(eventId));

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
