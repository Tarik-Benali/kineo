<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>rendez-vous</title>

  <style type="text/css">
    p, body, td { font-family: Tahoma, Arial, Helvetica, sans-serif; font-size: 10pt; }
    body { padding: 0px; margin: 0px; background-color: #ffffff; }
    a { color: #1155a3; }
    .space { margin: 10px 0px 10px 0px; }
    .header { background: #003267; background: linear-gradient(to right, #011329 0%,#00639e 44%,#011329 100%); padding:20px 10px; color: white; box-shadow: 0px 0px 10px 5px rgba(0,0,0,0.75); }
    .header a { color: white; }
    .header h1 a { text-decoration: none; }
    .header h1 { padding: 0px; margin: 0px; }
    .main { padding: 10px; margin-top: 10px; }
}
}
  </style>

  <!-- DayPilot library -->
  <script src="assets/js/daypilot/daypilot-all.min.js"></script>
</head>
<body>
<div class="header">
  <h1>rendez-vous</h1>
</div>

<div class="main">
  <div id="dp"></div>
</div>

<script>
  var dp = new DayPilot.Calendar("dp", {
    locale: "fr-fr",
    columnWidthSpec: "Auto",
    viewType: "Resources",
    headerLevels: 1,
    headerHeight: 30,
    cellHeight: 30,
    crosshairType: "Header",
    showCurrentTime: true,
    eventArrangement: "Cascade",
    allowEventOverlap: true,
    timeRangeSelectedHandling: "Enabled",
    onTimeRangeSelected: function (args) {
      DayPilot.Modal.prompt("Create a new event:", "Event 1").then(function(modal) {
        var dp = args.control;
        dp.clearSelection();
        if (!modal.result) { return; }
        dp.events.add(new DayPilot.Event({
          start: args.start,
          end: args.end,
          id: DayPilot.guid(),
          text: modal.result,
          resource: args.resource
        }));
      });
    },
    eventDeleteHandling: "Update",
    onEventDeleted: function (args) {
      this.message("Event deleted.");
    },
    eventMoveHandling: "Update",
    onEventMoved: function (args) {
      this.message("Event moved");
    },
    eventResizeHandling: "Update",
    onEventResized: function (args) {
      this.message("Event resized");
    },
    eventClickHandling: "Edit",
    eventEditHandling: "Update",
    onEventEdited: function (args) {
      this.message("Event edited");
    },
    eventHoverHandling: "Bubble",
    bubble: new DayPilot.Bubble({
      onLoad: function(args) {
        // if event object doesn't specify "bubbleHtml" property 
        // this onLoad handler will be called to provide the bubble HTML
        args.html = "Event details";
      }
    }),
    contextMenu: new DayPilot.Menu({
      items: [
        { text: "Delete", onClick: function(args) { var dp = args.source.calendar; dp.events.remove(args.source); } }
      ]
    }),
  });
  dp.events.list = [
    {
      id: "1",
      start: DayPilot.Date.today().addHours(11),
      end: DayPilot.Date.today().addHours(11.5),
      text: "Event 1",
      resource: "R1"
    }
  ];
  dp.columns = [
    {name: "Resource 1", id: "R1"},
    {name: "Resource 2", id: "R2"},
    {name: "Resource 3", id: "R3"},
    {name: "Resource 4", id: "R4"}
  ];
  dp.init();
</script>

</body>
</html>