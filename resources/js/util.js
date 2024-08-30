import axios from "axios";
import moment from "moment";

export const planStatus = (activities) => {
    if (activities.length) {
        moment.utc(activities[0].time).isAfter(moment().endOf("day"))
            ? "Upcoming"
            : moment
                .utc(activities[activities.length - 1].time)
                .isSameOrAfter(moment())
                ? "On Going"
                : "Completed";
    }
}

export const rangePlan = (plan, format = "LL") => {
    const start = moment(plan.start_date).local().format(format);
    const end = moment(plan.end_date).local().format(format);
    return start == end ? start : `${start} - ${end}`;
};

export const humanizeFromNow = (time) =>
    moment.utc(time).local().calendar(null, {
        sameDay: "[Today]",
        nextDay: "[Tomorrow]",
        nextWeek: "[Next] dddd",
        lastDay: "[Yesterday]",
        lastWeek: "[Last] dddd",
        sameElse: "D MMMM",
    });

export const placePhoto = (name) =>
    `https://places.googleapis.com/v1/${name}/media?key=${import.meta.env.VITE_MAPS_API_KEY
    }&maxHeightPx=400&maxWidthPx=600`;

export const previewImage = (file) => URL.createObjectURL(file);

export function dataURLtoFile(dataurl, filename) {
    var arr = dataurl.split(","),
        mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[arr.length - 1]),
        n = bstr.length,
        u8arr = new Uint8Array(n);
    while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new File([u8arr], filename, { type: mime });
}

export const formAxios = axios.create({
    transformRequest: [
        function (data, headers) {
            if (
                headers["Content-Type"] &&
                headers["Content-Type"].startsWith("multipart/form-data")
            ) {
                const form = new FormData();
                for (const key in data) {
                    const value = data[key];
                    if (Array.isArray(value)) {
                        const arrayKey = `${key}[]`;
                        value.forEach((v) => {
                            form.append(arrayKey, v);
                        });
                    } else {
                        form.append(key, value);
                    }
                }
                return form;
            }

            return data;
        },
    ],
});

export const numFormat = (num) =>
    Intl.NumberFormat("en", {
        notation: "compact",
    }).format(num);

export const debounce = (callback, wait) => {
    let timeoutId = null;
    return (...args) => {
        window.clearTimeout(timeoutId);
        timeoutId = window.setTimeout(() => {
            callback(...args);
        }, wait);
    };
};

export function upFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
// moment
//     .utc(time)
//     .local()
//     .fromNow()
//     .toLowerCase()
//     .split(" ")
//     .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
//     .join(" ");
