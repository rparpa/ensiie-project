FROM nginx:1.17

COPY ./config /tmp
RUN mv /tmp/site.conf /etc/nginx/conf.d/default.conf \
 && mv /tmp/entrypoint.sh /root/entrypoint.sh

RUN apt-get update \
    && apt-get install \
        tzdata

STOPSIGNAL SIGTERM

ENTRYPOINT ["/bin/sh","/root/entrypoint.sh"]
CMD ["nginx", "-g", "daemon off;"]
