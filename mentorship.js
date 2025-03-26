const express = require("express");
const MentorshipApplication = require("../models/MentorshipApplication");
const router = express.Router();

// GET: Fetch all mentorship applications
router.get("/applications", async (req, res) => {
  try {
    const applications = await MentorshipApplication.find();
    res.status(200).json(applications);
  } catch (error) {
    res.status(500).json({ message: "Error fetching applications", error });
  }
});

// PUT: Approve or Reject Application
router.put("/applications/:id", async (req, res) => {
  const { status } = req.body;

  if (!["Approved", "Rejected"].includes(status)) {
    return res.status(400).json({ message: "Invalid status" });
  }

  try {
    const application = await MentorshipApplication.findByIdAndUpdate(req.params.id, { status }, { new: true });

    if (!application) {
      return res.status(404).json({ message: "Application not found" });
    }

    res.status(200).json({ message: `Application ${status}`, application });
  } catch (error) {
    res.status(500).json({ message: "Error updating application", error });
  }
});

// DELETE: Delete an application
router.delete("/applications/:id", async (req, res) => {
  try {
    await MentorshipApplication.findByIdAndDelete(req.params.id);
    res.status(200).json({ message: "Application deleted successfully" });
  } catch (error) {
    res.status(500).json({ message: "Error deleting application", error });
  }
});

module.exports = router;
