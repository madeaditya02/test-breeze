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

export const rangePlan = (activities) => {
    if (activities.length) {
        const start = moment.utc(activities[0].time).local().format("LL");
        const end = moment
            .utc(activities[activities.length - 1].time)
            .local()
            .format("LL");
        return start == end ? start : `${start} - ${end}`;
    }
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
    }&maxHeightPx=360&maxWidthPx=320`;
// moment
//     .utc(time)
//     .local()
//     .fromNow()
//     .toLowerCase()
//     .split(" ")
//     .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
//     .join(" ");
