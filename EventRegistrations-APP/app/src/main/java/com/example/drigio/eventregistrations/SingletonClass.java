package com.example.drigio.eventregistrations;

import android.content.Context;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.Volley;

/**
 * Created by Drigio on 12/10/2017.
 */

public class SingletonClass {
    private static SingletonClass mInstance;
    private RequestQueue requestQueue;
    private static Context mCtx;

    private SingletonClass(Context context) {
        mCtx = context;
        requestQueue = getRequestQueue();
    }

    public static synchronized SingletonClass getmInstance(Context context) {
        if(mInstance == null) {
            mInstance = new SingletonClass(context);
        }
        return mInstance;
    }

    public RequestQueue getRequestQueue(){
        if(requestQueue == null) {
            requestQueue = Volley.newRequestQueue(mCtx.getApplicationContext());
        }
        return requestQueue;
    }

    public <T> void addToRequestQueue(Request<T> request) {
        requestQueue.add(request);
    }
}
